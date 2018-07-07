@extends('layouts.public')
@section('title')
    Inicio @parent
@endsection

@section('content')
    <div class="container">
        <div class="card-deck">
            <div class="card mb-4">
                <img class="card-img-top" src="/images/banners/enfasis2018.jpg" alt="Enfasis">
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
                    <p class="card-text">A continuación se muestran los cursos de educación cristiana disponibles para el semestre 2018-2.</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                        @if($member)
                            @if($past = $member->courses()->where('period','2018-1')->first())
                            <p class="card-text">El semestre 2018-1 te inscribiste en el curso
                                <span class="text-info">{{ $past->name }}</span> con
                                <span class="text-muted">{{ $past->professor->name }}</span>
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
                            @if($fields = $member->field_courses)
                                <p class="card-text">Anteriormente, nos informaste que ya has tomado los siguientes cursos: <br>
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
                            <p class="card-text">Tomando en cuenta esta información, te recomendamos que para este semestre tomes el curso: <span class="text-info">{{ $member->recommendCourse() }}</span></p>
                        @else
                            <p class="card-text">Debes ingresar al sistema para ver tu información</p>
                            <form action="/" method="post">
                                @csrf
                            <div class="form-group">
                                {{--<label for="email_phone">Ingresar</label>--}}
                                <input type="text" name="email_phone" class="form-control" id="email_phone" aria-describedby="emailHelp" placeholder="Escribir Email o teléfono">
                                <small id="emailHelp" class="form-text text-muted">Escriba la dirección de correo electrónico o el número celular</small>
                            </div>
                                <input type="submit" value="Ingresar" class="btn btn-sm btn-primary">
                            </form>
                        @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <hr class="my-4 border-bottom">
        {{--<img src="" class="rounded mx-auto d-block img-fluid" alt="">--}}
        @foreach($days as $day)
            <div class="row">
                <div class="col">
                    <h3>{{ $day['day'] }}</h3>
                    {{--<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>--}}
                </div>
            </div>
            <div class="row">
                @forelse($day['courses'] as $course)
                    <div class="col-md-4">
                        <div class="card {{ $course->style }} text-white mb-2 border-0">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <p class="card-text">{{ $course->dayName }} {{ $course->hour }}<br>
                                    {{ $course->professor->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="lead">No hay cursos disponibles para este día</p>
                    </div>
                @endforelse
            </div>
            <hr class="my-4 border-bottom">
        @endforeach
        {{--@foreach($courses->chunk(3) as $chunk)--}}
        {{--<div class="card-deck">--}}
        {{--@foreach($chunk as $course)--}}
        {{--<div class="card {{ $course->style }} text-white mb-2 border-0">--}}
        {{--<div class="card-body">--}}

        {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}
        {{--@endforeach--}}

    </div>
@endsection

