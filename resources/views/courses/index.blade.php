@extends('layouts.app')

@section('title')
    Educación Cristiana @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card mb-2">
                    <div class="card-body">
                        <a href="/courses/create" class="btn btn-primary">Agregar clase</a>        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-group">
            <div class="card">
                <div class="card-header text-white bg-info">Lunes</div>
                <div class="card-body">
                    @foreach(\App\PCO\Course::where('day',1)->orderBy('hour')->get() as $course)
                        @include('courses.summary')
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-info">Martes</div>
                <div class="card-body">
                    @foreach(\App\PCO\Course::where('day',2)->get() as $course)
                        @include('courses.summary')
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-info">Miércoles</div>
                <div class="card-body">
                    @foreach(\App\PCO\Course::where('day',3)->get() as $course)
                        @include('courses.summary')
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-info">Jueves</div>
                <div class="card-body">
                    @foreach(\App\PCO\Course::where('day',4)->get() as $course)
                        @include('courses.summary')
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header text-white bg-info">Domingo</div>
                <div class="card-body">
                    @foreach(\App\PCO\Course::where('day',0)->get() as $course)
                        @include('courses.summary')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
