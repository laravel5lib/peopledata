@extends('layouts.app')

@section('title')
    Buscar estudiantes @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Buscar estudiantes</h5>
            <div class="card-body">
                <students-search :course_id="{{ $course->id }}" add_url="/courses/{{ $course->id }}/add/"></students-search>
            </div>
        </div>
    </div>
@endsection
