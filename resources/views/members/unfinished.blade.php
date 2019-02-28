@extends('layouts.app')

@section('title')
    Estudiantes sin terminar @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Estudiantes que no completaron curso en {{ $period }}</h5>
            <div class="card-body">
                <a href="/courses/export?period={{ $period }}&status[]=didnt_start&status[]=didnt_finish" class="btn btn-secondary mb-2">Exportar Listado de Deserciones</a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-4"><strong>Estudiante</strong></div>
                        <div class="col-md-3"><strong>Curso</strong></div>
                        <div class="col-md-2"><strong>{{ config('elencuentro.period') }}</strong></div>
                        <div class="col-md-3"><strong>Enviar correo</strong></div>
                    </div>
                </li>
                @forelse($members as $member)
                    @php
                        $course = $member->courses()->where('period',$period)->wherePivotIn('status',['didnt_finish','didnt_start'])->first();
                        $course->append('dayName');
                        if($course2 = $member->courses()->where('period',config('elencuentro.period') )->first()){
                            $course2->append('dayName');
                        }
                    @endphp
                    <li class="list-group-item">
                        <student-unfinished :member="{{ $member }}" :course="{{ $course }}" :course2="{{ $course2??0 }}" :courses="{{ collect($available) }}"></student-unfinished>
                    </li>
                @empty
                    <li class="list-group-item">
                        No hay estudiantes sin terminar
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
