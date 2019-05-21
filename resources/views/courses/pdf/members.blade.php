@extends('layouts.pdf')
@section('title')
    {{ $course->name }} :: Hoja de Clase @parent
@endsection

@section('content')
    @include('members.pdf.member_professor', [
                'member'=>$course->professor,
                'courses'=>$course->professor->professorCourses()->orderBy('period','desc')->get()
                ])
    <div class="page-break"></div>
    <div class="page-break"></div>
    @include('members.pdf.member', [
                'member'=>$course->professor,
                'courses'=>$course->professor->courses()
                              ->orderBy('category','asc')
                              ->orderBy('period','asc')
                              ->wherePivot('status','<>','didnt_start')
                              ->wherePivot('status','<>','didnt_finish')
                              ->get()
                              ])
    <div class="page-break"></div>
    @foreach($course->members as $member)
        @include('members.pdf.member', [
                'courses'=>$member->courses()
                              ->orderBy('category','asc')
                              ->orderBy('period','asc')
                              ->wherePivot('status','<>','didnt_start')
                              ->wherePivot('status','<>','didnt_finish')
                              ->get()
                              ])
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
@endsection
