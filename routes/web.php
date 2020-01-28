<?php

Auth::routes();
Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');

Route::get('/', 'HomeController@index');
Route::any('mycourses', 'HomeController@mycourses');
Route::get('terms', 'HomeController@terms')->name('terms');

Route::resource('messages', 'Utils\MessagesController');

Route::resource('members', 'MemberController');
Route::get('members/unfinished/{period}', 'MemberController@unfinishedCourses');
Route::get('members/add/{id}', 'MemberController@add');
Route::get('members/{member}/professor-pdf', 'MemberController@professorPdf');
Route::get('members/{member}/student-pdf', 'MemberController@studentPdf');
Route::post('members/{member}/addimage', 'MemberController@addimage');
Route::post('members/{member}/recommend', 'MemberController@recommend');
Route::post('members/search', 'MemberController@search');
Route::post('members/simple-login', 'MemberController@simpleLogin');
Route::get('members/{member}/updateinfo', 'MemberController@updateinfo')->name('members.updateinfo')->middleware('signed');
Route::get('member-courses/{member}', 'Member\MemberCoursesController@index');

Route::get('courses/export', 'CoursesController@export');
Route::resource('courses', 'CoursesController');
Route::get('courses/{course}/students', 'CoursesController@students');
Route::get('courses/{course}/professor', 'CoursesController@professor');
Route::get('courses/{course}/summary/{professor}', 'CoursesController@professorSummary');
Route::get('courses/{course}/add/{member}', 'CoursesController@addStudent');
Route::post('courses/{course}/toggle/{member}', 'CoursesController@toggleStudent');
Route::get('courses/{course}/professoradd/{member}', 'CoursesController@addProfessor');
Route::post('courses/{course}/update-student/{member}', 'CoursesController@updateStudent');
Route::post('courses/{course}/remove-student/{member}', 'CoursesController@removeStudent');
Route::get('courses/{course}/remove-professor', 'CoursesController@removeProfessor');
Route::get('courses/{course}/search', 'CoursesController@search');
Route::get('courses/{course}/students2-pdf', 'CoursesController@listPdf');
Route::get('courses/{course}/students-pdf', 'CoursesController@studentPdf');

Route::resource('ministries', 'MinistryController');
Route::get('ministries/{ministry}/search', 'MinistryController@search');
Route::get('ministries/{ministry}/add/{member}', 'MinistryController@addMember');
Route::get('ministries/{ministry}/del/{member}', 'MinistryController@delMember');
Route::get('ministries/{ministry}/edit/{member}', 'MinistryController@editMember');


//Route::get('/mailable', function(){
//    $user = \App\User::find(1);
//    $mail = new \App\Mail\Courses\CoursePreRegisteredMail(\App\PCO\Course::find(1), $user);
//    \Illuminate\Support\Facades\Mail::to($user)->send($mail);
//    return $mail;
//});
