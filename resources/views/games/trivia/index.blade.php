@extends('layouts.app')

@section('title')
    Trivia @parent
@endsection
@section('content')

    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                @if($session->questions)
                    <div>
                        Ya se han respondido {{ count($session->questions) }} preguntas.
                        Puedes reiniciar las preguntas haciendo click a continuación: <br>
                        <a href="/games/trivia/reset" class="btn btn-info">Reiniciar preguntas</a>
                    </div>
                    <br>
                    <div>
                        O puedes continuar respondiendo <br>
                        <a href="/games/trivia/start" class="btn btn-primary">Continuar con las preguntas</a>
                    </div>
                @else
                    <div>
                        Para comenzar a responder preguntas, haz click a continuación: <br>
                        <a href="/games/trivia/start" class="btn btn-primary">Comenzar con las preguntas</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
