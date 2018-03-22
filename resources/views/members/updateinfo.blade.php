@extends('layouts.public')
@section('title')
    Actualización de datos personales @parent
@endsection
@section('content')
    <div class="container">
        <member-edit :initial="{{ $member }}" :marital_statuses="{{ $marital_statuses }}"></member-edit>
    </div>
@endsection
