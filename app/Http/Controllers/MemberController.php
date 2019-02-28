<?php

namespace App\Http\Controllers;

use App\User;
use App\Member;
use App\PCO\Course;
use App\PCO\Field;
use MediaUploader;
use Carbon\Carbon;
use App\MaritalStatus;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\Courses\CourseRecommendedMail;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['updateinfo', 'update', 'addimage', 'courses', 'simpleLogin', 'store', 'unfinishedCourses', 'recommend']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($id = request()->get('id')) {
            $members = Member::where('id', $id)->get();
            if ($members->count() == 0) {
                $members = collect([]);
                $client  = new Client();
                $res     = $client->get('https://api.planningcenteronline.com/people/v2/people?where[id]=' . $id, ['auth' => [config('services.people.id'), config('services.people.secret')]]);
                if ($res->getStatusCode() == 200) {
                    $response = json_decode($res->getBody(), true);
                    if (isset($response['data'])) {
                        foreach ($response['data'] as $mb) {
                            $members->push(Member::firstOrCreate(['id' => $mb['id']]));
                        }
                    }
                }
            }
        } else {
            $members = Member::orderBy('updated_at', 'desc')->get();
//            $res = $client->get('https://api.planningcenteronline.com/people/v2/people', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        }

        return view('members.index', compact('members'));
    }


    /**
     * @param Member $member
     * @return Member
     */
    public function updateinfo(Member $member)
    {
        $member->updateFromPeople();
        $member->append(['image', 'profession', 'working', 'company', 'field_courses']);
        $marital_statuses = MaritalStatus::all();
        $courses          = Field::where('tab_id', 47880)->orderBy('sequence')->get();

        return view('members.updateinfo', compact('member', 'marital_statuses', 'courses'));
    }

    /**
     * Adds new record and redirects
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add($id)
    {
        $member = Member::firstOrCreate(['id' => $id]);
        $member->updateFromPeople();

        return redirect('members/' . $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => 'required|min:3',
            'last_name'  => 'required|min:3',
            'email'      => 'required|email',
        ]);
        $results = [];
        $client  = new Client();
        $data    = [
            'type'       => 'Person',
            'attributes' => [
                'first_name' => request()->get('first_name'),
                'last_name'  => request()->get('last_name'),
            ],
        ];
        $res     = $client->post('https://api.planningcenteronline.com/people/v2/people',
            ['auth' => [config('services.people.id'), config('services.people.secret')],
             'json' => ['data' => $data],
            ]
        );
        if ($res->getStatusCode() == 200 || $res->getStatusCode() == 201) {
            $response = json_decode($res->getBody(), true);
//            $results['response'] = $response;
            if (isset($response['data']['id'])) {
                $member = Member::firstOrCreate(['id' => $response['data']['id']]);
                if ($email = request()->get('email')) {
                    $client_email = new Client();
                    $res_email    = $client_email->post('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '/emails',
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'Email', 'attributes' => ['address' => $email, 'location' => 'Home', 'primary' => true]]],
                        ]
                    );
                    if ($res_email->getStatusCode() == 200 || $res_email->getStatusCode() == 201) {
                        $member->email = $email;
                        $member->save();
                    }
                }
                if ($phone = request()->get('phone')) {
                    $client_phone = new Client();
                    $res_phone    = $client_phone->post('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '/phone_numbers',
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'PhoneNumber', 'attributes' => ['number' => $phone, 'location' => 'Mobile', 'primary' => true]]],
                        ]
                    );
                    if ($res_phone->getStatusCode() == 200 || $res_phone->getStatusCode() == 201) {
                        $member->phone = $phone;
                        $member->save();
                    }
                }
                $member->updateFromPeople();
                $results['member'] = $member;
            }
        }

        return $results;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member->updateFromPeople();
        $member->append(['image', 'profession', 'working', 'company', 'field_courses']);
        $marital_statuses = MaritalStatus::all();
        $courses          = Field::where('tab_id', 47880)->orderBy('sequence')->get();

        return view('members.edit', compact('member', 'marital_statuses', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Member $member
     * @return array
     */
    public function update(Member $member)
    {
        $this->validate(request(), [
            'first_name' => 'required|min:3',
            'last_name'  => 'required|min:3',
            'gender'     => 'required',
            'email'      => 'nullable|email',
        ]);
        $results = [];
        $client  = new Client();
        $data    = [
            'type'       => 'Person', 'id' => $member->id,
            'attributes' => [
                'first_name' => request()->get('first_name'),
                'last_name'  => request()->get('last_name'),
                'birthdate'  => request()->get('birthdate'),
                'gender'     => request()->get('gender'),
            ],
        ];
        if ($marital = request()->get('marital_status_id')) {
            $data['relationships'] = [
                'marital_status' => [
                    'data' => [
                        'type' => 'MaritalStatus',
                        'id'   => $marital,
                    ],
                ],
            ];
        }
        $res = $client->patch('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '?include=emails,phone_numbers,marital_status',
            ['auth' => [config('services.people.id'), config('services.people.secret')],
             'json' => ['data' => $data],
            ]
        );
        if ($res->getStatusCode() == 200) {
            $response = json_decode($res->getBody(), true);
            $member->updateWithJson($response);
            if ($email = request()->get('email')) {
                if (isset($response['data']['relationships']['emails']['data'][0])) {
                    $email_id     = $response['data']['relationships']['emails']['data'][0]['id'];
                    $client_email = new Client();
                    $res_email    = $client_email->patch('https://api.planningcenteronline.com/people/v2/emails/' . $email_id,
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'Email', 'id' => $email_id, 'attributes' => ['address' => $email]]],
                        ]
                    );
                    if ($res_email->getStatusCode() == 200) {
                        $member->email = $email;
                        $member->save();
                    }
                } else {
                    $client_email = new Client();
                    $res_email    = $client_email->post('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '/emails',
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'Email', 'attributes' => ['address' => $email, 'location' => 'Home', 'primary' => true]]],
                        ]
                    );
                    if ($res_email->getStatusCode() == 200 || $res_email->getStatusCode() == 201) {
                        $member->email = $email;
                        $member->save();
                    }
                }
            }
            if ($phone = request()->get('phone')) {
                if (isset($response['data']['relationships']['phone_numbers']['data'][0])) {
                    $phone_id     = $response['data']['relationships']['phone_numbers']['data'][0]['id'];
                    $client_phone = new Client();
                    $res_phone    = $client_phone->patch('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '/phone_numbers/' . $phone_id,
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'PhoneNumber', 'id' => $phone_id, 'attributes' => ['number' => $phone]]],
                        ]
                    );
                    if ($res_phone->getStatusCode() == 200) {
                        $member->phone = $phone;
                        $member->save();
                    }
                } else {
                    $client_phone = new Client();
                    $res_phone    = $client_phone->post('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '/phone_numbers',
                        ['auth' => [config('services.people.id'), config('services.people.secret')],
                         'json' => ['data' => ['type' => 'PhoneNumber', 'attributes' => ['number' => $phone, 'location' => 'Mobile', 'primary' => true]]],
                        ]
                    );
                    if ($res_phone->getStatusCode() == 200 || $res_phone->getStatusCode() == 201) {
                        $member->phone = $phone;
                        $member->save();
                    }
                }
            }
        }
        if ($profession = request()->get('profession')) $member->profession = $profession;
        if ($working = request()->get('working')) $member->working = $working;
        if ($company = request()->get('company')) $member->company = $company;
        if ($courses = request()->get('courses')) {
            $actual_courses = $member->field_courses;
            $allcourses     = Field::where('tab_id', 47880)->orderBy('sequence')->get();
            foreach ($allcourses as $course) {
                if (isset($courses[$course->id]) && (
                        !isset($actual_courses[$course->id]) ||
                        ($courses[$course->id] != $actual_courses[$course->id])
                    )) {
                    $member->updateFieldValue($course->id, $courses[$course->id]);
                }
            }
        }
        $member->append(['image', 'profession', 'working', 'company', 'field_courses']);
        $member->authorization = Carbon::now();
        $member->save();
        $results['data'] = $member;

        return $results;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }

    /**
     * @param Member $member
     * @return array
     */
    public function addimage(Member $member)
    {
        $results = [];
        $this->validate(request(), [
            'file' => 'required|image',
        ]);
        $media = MediaUploader::fromSource(request()->file('file'))
//            ->useHashForFilename()
                              ->useFilename(cleanUrl(request()->file('file')->getClientOriginalName(), true))
                              ->toDisk('public')->toDirectory('members/' . $member->id)->upload();
//        $extension = substr($media->getUrl(), strrpos($media->getUrl(), '.'));
//        $media->rename(cleanUrl($media->basename));
//        $media->save();
        $member->syncMedia($media, 'avatar');
        $client = new Client();
        $res    = $client->post('https://upload.planningcenteronline.com/v2/files',
            [
                'auth'      => [config('services.people.id'), config('services.people.secret')],
                'multipart' => [
                    [
                        'name'     => 'file',
                        'contents' => file_get_contents($media->getUrl()),
                        'filename' => $media->basename,
                    ],
                ],
            ]
        );
        if ($res->getStatusCode() == 201) {
            $response = json_decode($res->getBody(), true);
            if (isset($response['data'])) {
                if (isset($response['data'][0])) {
                    $fileid  = $response['data'][0]['id'];
                    $client2 = new Client();
                    $res2    = $client2->patch('https://api.planningcenteronline.com/people/v2/people/' . $member->id,
                        [
                            'auth' => [config('services.people.id'), config('services.people.secret')],
                            'json' => [
                                'data' => [
                                    'type'       => 'Person',
                                    'id'         => $member->id,
                                    'attributes' => [
                                        'avatar' => $fileid,
                                    ],
                                ],
                            ],
                        ]
                    );
                    if ($res2->getStatusCode() == 200) {
                        $response2 = json_decode($res2->getBody(), true);
                        $member->updateWithJson($response2);
                    }
                }
            }
        } else {
            $response = json_decode($res->getBody(), true);

            return ['error' => $response, 'phrase' => $res->getReasonPhrase(), 'code' => $res->getStatusCode()];
        }
        $member->append('image');
        $results['data'] = $member;

        return $results;
    }

    /**
     * @return array
     */
    public function search()
    {
        $results = [];
        if ($query = request()->get('search')) {
            $members = Member::where('name', 'like', '%' . $query . '%')
                             ->orWhere('first_name', 'like', '%' . $query . '%')
                             ->orWhere('last_name', 'like', '%' . $query . '%')
                             ->orWhere('email', 'like', '%' . $query . '%')
                             ->orWhere('phone', 'like', '%' . $query . '%')
                             ->get();
            $members->each->append(['image', 'profession', 'working', 'company', 'field_courses']);
            $results['members'] = $members;
        }

        if (request()->ajax()) return $results;
        return view('members.index', compact('members'));
    }

    /**
     * @param Member $member
     * @return mixed
     */
    public function courses(Member $member)
    {
        $member->updateFromPeople();
        $user = User::firstOrCreate(['email' => $member->email]);
        if (!$user->name) {
            $user->name = $member->name;
            $user->save();
        }
        $user->member()->associate($member);
        $user->save();
        Auth::login($user, true);

        return redirect('/');
    }

    public function simpleLogin()
    {
        $this->validate(request(), [
            'email_phone' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!($member = Member::where('email', 'like', $value)->orWhere('phone', 'like', $value)->first())) {
                        return $fail('No encontramos tus datos en el sistema. Intenta nuevamente.');
                    }
                },
            ],
        ]);
        $results           = [];
        $data              = request()->get('email_phone');
        $member            = Member::where('email', 'like', $data)->orWhere('phone', 'like', $data)->first();
        $results['member'] = $member;

        return $results;
    }

    public function unfinishedCourses($period = null)
    {
        if(!$period)$period = config('elencuentro.period');
        $members = Member::whereHas('courses', function ($query) use ($period) {
            $query->where('period', $period)->whereIn('course_member.status', ['didnt_finish', 'didnt_start']);
        })->get();
        $members->each->append('image');
        $available = [];
        foreach (Course::where('period', config('elencuentro.period'))->orderBy('name')->get() as $cr) {
            if (!in_array($cr->name, $available)) $available[] = $cr->name;
        }

        return view('members.unfinished', compact('members', 'period', 'available'));
    }

    /**
     * @param Member $member
     * @return array
     */
    public function recommend(Member $member)
    {
        $course_name = request()->get('course', '');
        $results     = [];
        Mail::to($member->email)->send(new CourseRecommendedMail($course_name, $member));
        $results['status']  = 'success';
        $results['message'] = 'Mensaje enviado correctamente';

        return $results;
    }

}
