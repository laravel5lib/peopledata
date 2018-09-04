@extends('layouts.app')

@section('title')
    Editar: {{ $member->name }} @parent
@endsection

@section('content')
<div class="container">
    <member-edit :initial="{{ $member }}" :marital_statuses="{{ $marital_statuses }}" :courses="{{ $courses }}" back_url="/ministries/{{ $ministry->id  }}"></member-edit>
</div>
@endsection
