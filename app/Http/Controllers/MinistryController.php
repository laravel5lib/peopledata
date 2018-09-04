<?php

namespace App\Http\Controllers;

use App\MaritalStatus;
use App\Member;
use App\Ministry;
use App\PCO\Field;
use App\User;
use Illuminate\Http\Request;

class MinistryController extends Controller
{

    public function index()
    {
        $ministries = Ministry::all();

        return view('ministries.index', compact('ministries'));
    }

    public function show(Ministry $ministry)
    {
        return view('ministries.show', compact('ministry'));
    }

    public function search(Ministry $ministry)
    {
        return view('ministries.search', compact('ministry'));
    }

    public function addMember(Ministry $ministry, Member $member)
    {
        $ministry->members()->attach($member);
        if (request()->ajax()) {
            $results            = [];
            $results['status']  = 'success';
            $results['message'] = 'Registro agregado!';

            return $results;
        }

        return redirect('ministries/' . $ministry->id);
    }
    public function delMember(Ministry $ministry, Member $member)
    {
        $ministry->members()->detach($member);
        if (request()->ajax()) {
            $results            = [];
            $results['status']  = 'success';
            $results['message'] = 'Registro eliminado!';

            return $results;
        }

        return redirect('ministries/' . $ministry->id);
    }

    public function editMember(Ministry $ministry, Member $member)
    {
        $member->updateFromPeople();
        $member->append(['image', 'profession','working','company','field_courses']);
        $marital_statuses = MaritalStatus::all();
        $courses = Field::where('tab_id',47880)->orderBy('sequence')->get();
        return view('ministries.edit_member', compact('ministry','member', 'marital_statuses', 'courses'));
    }

}
