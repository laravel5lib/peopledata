<?php

namespace App\Http\Controllers;

use App\MaritalStatus;
use App\Member;
use MediaUploader;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['updateinfo', 'update', 'addimage']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = collect([]);
        $client  = new Client();
        if ($id = request()->get('id')) {
            $res = $client->get('https://api.planningcenteronline.com/people/v2/people?where[id]=' . $id, ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        } else {
            $res = $client->get('https://api.planningcenteronline.com/people/v2/people', ['auth' => [config('services.people.id'), config('services.people.secret')]]);
        }
        if ($res->getStatusCode() == 200) {
            $response = json_decode($res->getBody(), true);
            if (isset($response['data'])) {
                foreach ($response['data'] as $mb) {
                    $members->push(Member::firstOrCreate(['id' => $mb['id']]));
                }
            }
        }
        return view('members.index', compact('members'));
    }


    /**
     * @param $id
     * @return Member
     */
    public function updateinfo($id)
    {
        $member = Member::firstOrCreate(['id' => $id]);
        $member->updateFromPeople();
        $member->append('image');
        $marital_statuses = MaritalStatus::all();
        return view('members.updateinfo', compact('member', 'marital_statuses'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('members.edit', compact('member'));
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
            'birthdate'  => 'required|date',
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
            ]
        ];
        if ($marital = request()->get('marital_status_id')) {
            $data['relationships'] = [
                'marital_status' => [
                    'data' => [
                        'type' => 'MaritalStatus',
                        'id'   => $marital
                    ]
                ]
            ];
        }
        $res = $client->patch('https://api.planningcenteronline.com/people/v2/people/' . $member->id . '?include=emails,phone_numbers,marital_status',
            ['auth' => [config('services.people.id'), config('services.people.secret')],
             'json' => ['data' => $data]
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
                         'json' => ['data' => ['type' => 'Email', 'id' => $email_id, 'attributes' => ['address' => $email]]]
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
                         'json' => ['data' => ['type' => 'Email', 'attributes' => ['address' => $email, 'location' => 'Home', 'primary' => true]]]
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
                         'json' => ['data' => ['type' => 'PhoneNumber', 'id' => $phone_id, 'attributes' => ['number' => $phone]]]
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
                         'json' => ['data' => ['type' => 'PhoneNumber', 'attributes' => ['number' => $phone, 'location' => 'Mobile', 'primary' => true]]]
                        ]
                    );
                    if ($res_phone->getStatusCode() == 200 || $res_phone->getStatusCode() == 201) {
                        $member->phone = $phone;
                        $member->save();
                    }
                }
            }
        }
        $member->append('image');
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
            'file' => 'required|image'
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
                    ]
                ]
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
                                        'avatar' => $fileid
                                    ]
                                ]
                            ]
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
}
