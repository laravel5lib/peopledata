@extends('layouts.app')

@section('title')
    Buscar profesor @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Buscar profesor</h5>
            <div class="card-body">
                <students-search :course_id="{{ $course->id }}" add_url="/courses/{{ $course->id }}/professoradd/"></students-search>
            </div>
        </div>
    </div>
@endsection
