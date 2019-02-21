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
                        <div class="row">
                            <div class="col">
                                <select id="period" class="form-control" onChange="document.location.href='/courses?period='+document.getElementById('period').options[document.getElementById('period').selectedIndex].value">
                                    <option {{ $period=='2018-1'?'selected':'' }} value="2018-1">2018-1</option>
                                    <option {{ $period=='2018-2'?'selected':'' }} value="2018-2">2018-2</option>
                                    <option {{ $period=='2019-1'?'selected':'' }} value="2019-1">2019-1</option>
                                    <option {{ $period=='nuevos'?'selected':'' }} value="nuevos">nuevos</option>
                                </select>
                            </div>
                            <div class="col">
                                <a href="/courses/export?period={{ $period }}" class="btn btn-block btn-secondary mb-2"><i class="fal fa-file-excel"></i> Exportar Lista de Estudiantes</a>
                                <a href="/members/unfinished/{{ $period }}" class="btn btn-block btn-secondary"><i class="fal fa-user-slash"></i> Ver deserciones</a>
                            </div>
                            <div class="col">
                                <compose-message label="Escribir a los Profes" :emails="{{ collect($professorEmails) }}"></compose-message>
                                <a href="/courses/create" class="btn btn-primary btn-block">
                                    <i class="fal fa-plus"></i> Agregar clase
                                </a>
                            </div>
                            <div class="col">
                                <form action="/members/search" method="post">
                                    {{ csrf_field() }}
                                <div>Buscar estudiante:</div>
                                <div class="input-group mb-3">
                                    <input name="search" type="text" class="form-control" placeholder="Nombre del estudiante" aria-label="Nombre del estudiante" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fal fa-search"></i></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-group">
            @php
                $days = ['1'=>'Lunes','2'=>'Martes','3'=>'Miércoles','4'=>'Jueves','5'=>'Viernes','6'=>'Sábado','0'=>'Domingo'];
            @endphp
            @foreach($days as $index=>$day)
                @if(($courses = \App\PCO\Course::where('period',$period)->where('day',$index)->orderBy('hour')->get()) && $courses->count())
                    <div class="card">
                        <div class="card-header text-white bg-info">{{ $day }}</div>
                        <div class="card-body">
                            @foreach($courses as $course)
                                @include('courses.summary')
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
