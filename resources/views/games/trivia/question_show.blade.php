@extends('layouts.app')

@section('title')
    Trivia @parent
@endsection
@section('content')
    <div class="container">
        <trivia-question-show :question="{{ $question }}"></trivia-question-show>
    </div>
@endsection
    