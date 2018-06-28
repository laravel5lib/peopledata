<?php

namespace App\Http\Controllers;

use App\Member;
use App\PCO\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $period = request()->get('period','2018-2');
        return view('courses.index', compact('period'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function students(Course $course)
    {
        $members = $course->members;
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addStudent(Course $course, Member $member)
    {
        $course->members()->attach($member);
        return redirect('courses/'.$course->id.'/students');
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
        $results = [];
        $course->members()->detach($member->id);
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
}
