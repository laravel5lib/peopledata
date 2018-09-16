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
                                </select>
                            </div>
                            <div class="col"><a href="/courses/export" class="btn btn-secondary">Exportar</a></div>
                            <div class="col"><a href="/courses/create" class="btn btn-primary">Agregar clase</a></div>
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
