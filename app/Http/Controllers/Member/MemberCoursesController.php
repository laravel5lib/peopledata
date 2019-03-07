<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\Http\Controllers\Controller;

class MemberCoursesController extends Controller
{
    public function index(Member $member)
    {
        $results = [];
        $results['courses'] = $member->courses()->orderBy('category','asc')->orderBy('period','asc')->get();
        $results['professor_courses'] = $member->professorCourses()->orderBy('period','asc')->get();
        return $results;
    }
}
