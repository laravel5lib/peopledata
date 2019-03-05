@extends('layouts.app')

@section('title')
    Detalles de miembro @parent
@endsection

@section('content')
    <div class="container">
        <member-show :member="{{ $member }}" :courses="{{ $courses }}" :marital_statuses="{{ $marital_statuses }}"></member-show>
    </div>
@endsection
