@extends('layouts.app')

@section('title')
    Inscripciones a Curso @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Estudiantes inscritos al curso</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <h5 class="card-title">{{ $course->name }}<br>
                            <small class="text-muted">{{ $course->dayName }} {{ $course->hour }}<br>
                                ${{ number_format($course->value,0,',','.') }}<br>
                                {{ $course->location }}
                            </small>
                        </h5>
                    </div>
                    <div class="col-md-1">
                        @if($course->professor)
                            <img src="{{ $course->professor->image }}" alt="{{ $course->professor->name  }}" class="rounded-circle img-fluid img-thumbnail mb-1" width="100">
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if($course->professor)
                            <h6 class="card-title">
                                <strong>Profesor:</strong>
                                <a href="/members/{{ $course->professor->id }}/edit">{{ $course->professor->first_name }} {{ $course->professor->last_name }}</a><br>
                                <small class="text-muted">{{  $course->professor->email }}</small>
                                <br>
                                <small class="text-muted">Tel: {{  $course->professor->phone }}</small>
                            </h6>
                        @endif
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="/courses/{{ $course->id }}/edit" class="btn btn-primary"><i class="fal fa-edit"></i></a>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-4"><strong>Estudiante</strong></div>
                        <div class="col-md-2"><strong>Estado</strong></div>
                        <div class="col-md-2"><strong>Pago</strong></div>
                        <div class="col-md-3"><strong>Observaciones</strong></div>
                        <div class="col-md-1">&nbsp;</div>
                    </div>
                </li>
                @forelse($members->whereNotIn('pivot.status',['didnt_start','didnt_finish']) as $member)
                    <li class="list-group-item list-group-item-{{ $member->calculateClass($member->pivot->status) }}">
                        <student-inscription :member="{{ $member }}" :course_id="{{ $course->id }}"></student-inscription>
                    </li>
                @empty
                    <li class="list-group-item">
                        No hay estudiantes inscritos
                    </li>
                @endforelse
            </ul>
            <div class="card-body">
                <a href="/courses/{{ $course->id }}/search" class="btn btn-success">Agregar estudiante</a>
                <a href="/courses" class="btn btn-secondary">Cancelar</a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-12"><strong>Estudiantes que cancelaron o no empezaron el curso</strong></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-4"><strong>Estudiante</strong></div>
                        <div class="col-md-2"><strong>Estado</strong></div>
                        <div class="col-md-2"><strong>Pago</strong></div>
                        <div class="col-md-3"><strong>Observaciones</strong></div>
                        <div class="col-md-1">&nbsp;</div>
                    </div>
                </li>
                @foreach($members->whereIn('pivot.status',['didnt_start','didnt_finish']) as $member)
                    <li class="list-group-item list-group-item-{{ $member->calculateClass($member->pivot->status) }}">
                        <student-inscription :member="{{ $member }}" :course_id="{{ $course->id }}"></student-inscription>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
