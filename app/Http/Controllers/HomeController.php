<?php

namespace App\Http\Controllers;

use App\Member;
use App\PCO\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','terms']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($data = request()->get('email_phone')){
            if($member = Member::where('email','like',$data)->orWhere('phone','like',$data)->first()){
                return redirect('members/'.$member->id.'/courses');
            }
        }
        $period = request()->get('period','2018-2');
        $days = [
            '1'=>['day'=>'Lunes'],
            '2'=>['day'=>'Martes'],
            '3'=>['day'=>'Miércoles'],
            '4'=>['day'=>'Jueves'],
            '5'=>['day'=>'Viernes'],
            '6'=>['day'=>'Sábado'],
            '0'=>['day'=>'Domingo']
        ];
        foreach ($days as $key=>$day){
            $days[$key]['courses'] = Course::where('period',$period)->where('day',$key)->orderBy('hour')->get();
        }
        $member = null;
        if(auth()->check()){
            auth()->user()->fixMember();
            $member = auth()->user()->member;
        }
        return view('home', compact('days','member'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('pages.terms');
    }
}
