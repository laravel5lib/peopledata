@extends('layouts.public')
@section('title')
    Inicio @parent
@endsection

@section('content')
    <div class="container">
        <div class="card-deck">
            <div class="card mb-4">
                <img class="card-img-top" src="/images/banners/enfasis2019.jpg" alt="Énfasis">
            </div>
            <div class="card mb-4">
                <img class="card-img-top" src="/images/banners/ruta2018-2.jpeg" alt="Ruta">
            </div>
        </div>
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ministerio de Educación Cristiana <br>
                        <small class="text-muted">Proceso de inscripción de cursos</small>
                    </h5>
                    @if($member)
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img src="{{ $member->image }}" alt="{{ $member->name }}" class="rounded-circle img-fluid img-thumbnail mb-1" width="100">
                            </div>
                            <div class="col-md-9">
                                {{ $member->first_name }} {{ $member->last_name }}<br>
                                <small class="text-muted">{{ $member->email }}</small>
                                <br>
                                <small class="text-muted">Tel: {{ $member->phone }}</small>
                                <br>
                                <a href="/members/{{ $member->id }}/edit" class="btn btn-primary btn-sm">Editar</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();">
                                    {{ __('Salir') }}
                                </a>

                                <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                    <p class="card-text">A continuación se muestran los cursos de educación cristiana disponibles para el semestre 2019-1.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if($member)
                        @if($past = $member->courses()->where('period','2018-1')->first())
                            <p class="card-text">El semestre 2018-1 te inscribiste en el curso
                                <span class="text-info">{{ $past->name }}</span> con
                                @if($past->professor)
                                    <span class="text-muted">{{ $past->professor->name }}</span>
                                @endif
                                @if($past->pivot->status == 'completed')
                                    y lo <span class="text-success">terminaste</span> correctamente.
                                @elseif($past->pivot->status == 'didnt_finish')
                                    pero <span class="text-warning">no terminaste</span> correctamente.
                                @elseif($past->pivot->status == 'didnt_start')
                                    pero <span class="text-danger">no lo tomaste</span>.
                                @endif
                            </p>
                        @else
                            <p class="card-text">El semestre 2018-1, no tenemos registro que te hayas inscrito en ningun curso.</p>
                        @endif
                        @if(($fields = $member->field_courses_taken) && count($fields))
                            <p class="card-text">Anteriormente, nos informaste que ya has tomado los siguientes cursos:
                                <br>
                                @foreach($fields as $field=>$value)
                                    @php
                                        $field_name = \App\PCO\Field::find($field)->name;
                                    @endphp
                                    @if(in_array($value, ['Si','En curso actualmente']) &&(!$past || $past->name!=$field_name))
                                        <span class="text-info">{{ $field_name }}</span>,
                                    @endif
                                @endforeach
                            </p>
                        @else
                            <p class="card-text">Tampoco tenemos registrado en nuestro sistema que hayas tomado algún otro curso anteriormente.</p>
                        @endif
                        {{--<p class="card-text">Tomando en cuenta esta información, para este semestre podrías tomar el curso:--}}
                            {{--<span class="text-info">{{ $member->recommendCourse() }}</span></p>--}}
                    @else
                        <simple-login></simple-login>
                    @endif
                </div>
            </div>
        </div>
        <hr class="my-4 border-bottom">
        <blockquote class="blockquote">
            <p class="mb-0">Para inscribirte en uno de los cursos a continuación, solo debes hacer click sobre el. 
                Para cancelar una inscripción puedes dar click nuevamente sobre el curso. Los cursos que aparecen en color <span class="badge grow_early text-white">verde</span> son los que tienes inscritos en el momento.</p>
        </blockquote>
        @foreach($days as $day)
            <div class="row">
                <div class="col">
                    <h3>{{ $day['day'] }}</h3>
                </div>
            </div>
            <div class="row">
                @forelse($day['courses'] as $course)
                    <div class="col-md-4">
                        <course-register-small ini_status="{{ in_array($course->id,$signed_courses)?'signed':'' }}" :member="{{ $member??0 }}" :course="{{ $course }}"></course-register-small>
                    </div>
                @empty
                    <div class="col">
                        <p class="lead">No hay cursos disponibles para este día</p>
                    </div>
                @endforelse
            </div>
            <hr class="my-4 border-bottom">
        @endforeach
    </div>
@endsection

