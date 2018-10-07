@extends('layouts.app')

@section('title')
    Inscripciones a Curso @parent
@endsection

@section('content')
    <div class="container">
        <course-details :course="{{ $course }}"></course-details>
    </div>
@endsection
