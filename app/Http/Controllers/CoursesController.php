<?php

namespace App\Http\Controllers;

use App\User;
use App\Member;
use App\PCO\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\CoursesMembersExport;
use App\Notifications\CourseRegisterChangedNotification;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['professorSummary']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $period = request()->get('period',config('elencuentro.period'));
        $courses = Course::where('period',$period)->get();
        $periods = Course::select('period')->distinct()->orderBy('period')->pluck('period');
        $professorEmails = [];
        foreach($courses as $course){
            if($prof = $course->professor){
                if($prof->email && !in_array($prof->email, $professorEmails))$professorEmails[] = $prof->email;
            }
        }
        return view('courses.index', compact('period', 'professorEmails','periods'));
    }

    public function export()
    {
        $period = request()->get('period',config('elencuentro.period'));
        $status = request()->get('status',[]);
//        $days = ['1' => 'Lunes', '2' => 'Martes', '3' => 'Miércoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sábado', '0' => 'Domingo'];
//        $courses = Course::where('period', $period)->with('members')->get();
//        return view('courses.export', compact('days', 'courses'));
        return new CoursesMembersExport($period, $status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

   
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name'=>'required|min:3'
        ]);
        $course = Course::create(request()->all());
        return redirect('/courses/'.$course->id . '/edit');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Course $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate(request(),[
            'name'=>'required|min:3',
            'day'=>'required',
            'hour'=>'required',
            'status'=>'required',
            'period'=>'required',
        ]);
        $course->update(request()->all());
        return redirect('/courses?period='.$course->period);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function students(Course $course)
    {
        if(request()->ajax()){
            $results = [];
            $results['members'] = $course->members()->orderBy('name')->get();
            $results['members']->each->append('image');
            return $results;
        }
        $course->append('dayName');
        if($course->professor)$course->professor->append('image');
        $members = $course->members()->orderBy('name')->get();
        $members->each->append('image');
        return view('courses.students', compact('course','members'));
    }
    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function professor(Course $course)
    {
        return view('courses.professorsearch', compact('course'));
    }
    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Course $course)
    {
        return view('courses.search', compact('course'));
    }

    /**
     * @param Course $course
     * @param Member $member
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addStudent(Course $course, Member $member)
    {
        $admin = User::find(1);
        $course->members()->attach($member);
        $admin->notify(new CourseRegisterChangedNotification($member, $course, 'registrado', auth()->user()));
        if(request()->ajax()){
            $results = [];
            $results['status'] = 'success';
            $results['message'] = 'Inscripción realizada!';
            return $results;
        }
        return redirect('courses/'.$course->id.'/students');
    }
    /**
     * @param Course $course
     * @param Member $member
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function toggleStudent(Course $course, Member $member)
    {
        $admin = User::find(1);
        $results = [];
        $results['toggle'] = $course->members()->toggle($member->id);
        $results['status'] = 'success';
        if(count($results['toggle']['attached'])){
            $admin->notify(new CourseRegisterChangedNotification($member, $course, 'registrado', auth()->user()));
            $results['message'] = 'Te has registrado correctamente!';
        } elseif(count($results['toggle']['detached'])){
            $admin->notify(new CourseRegisterChangedNotification($member, $course, 'eliminado',auth()->user()));
            $results['message'] = 'Has cancelado la inscripción!';
        } else {
            $results['message'] = 'Cambio realizado';
        }
        
        $results['students'] = $course->members()->count();
        return $results;

    }
    /**
     * @param Course $course
     * @param Member $member
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addProfessor(Course $course, Member $member)
    {
        $course->professor()->associate($member);
        $course->save();
        return redirect('courses/'.$course->id.'/edit');
    }

    /**
     * @param Course $course
     * @param Member $member
     * @return array
     */
    public function updateStudent(Course $course, Member $member)
    {
        $results = [];
        $course->members()->updateExistingPivot($member->id,[
            'status'=>request()->get('status'),
            'payment'=>request()->get('payment'),
            'notes'=>request()->get('notes'),
        ]);
        $results['status'] = 'success';
        $results['message'] = 'Información actualizada!';

        return $results;
    }
    /**
     * @param Course $course
     * @param Member $member
     * @return array
     */
    public function removeStudent(Course $course, Member $member)
    {
        $admin = User::find(1);
        $results = [];
        $course->members()->detach($member->id);
        $admin->notify(new CourseRegisterChangedNotification($member, $course, 'eliminado', auth()->user()));
        $results['status'] = 'success';
        $results['message'] = 'Estudiante eliminado!';
        return $results;
    }
    /**
     * @param Course $course
     * @return array
     */
    public function removeProfessor(Course $course)
    {
        $course->professor()->dissociate();
        $course->save();
        return back();
    }

    /**
     * Logins a user adisplays course students edit page
     * @param Course $course
     * @param Member $professor
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function professorSummary(Course $course, Member $professor)
    {
        $user = User::firstOrCreate(['email'=>$professor->email]);
        if(!$user->name){
            $user->name = $professor->name;
            $user->save();
        }
        $user->member()->associate($professor);
        $user->save();
        Auth::login($user, true);
        return redirect('/courses/'.$course->id . '/students');
        
    }
}
