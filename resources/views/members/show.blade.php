@extends('layouts.app')

@section('title')
    Detalles de miembro @parent
@endsection

@section('content')
    <div class="container">
        <member-show :member="{{ $member }}" :courses="{{ $courses }}"></member-show>
    </div>
@endsection
