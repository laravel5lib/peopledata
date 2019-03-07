@extends('layouts.app')

@section('title')
    {{ $member->name }} :: Detalles de miembro @parent
@endsection

@section('content')
    <div class="container">
        <member-show :member="{{ $member }}" :old_courses="{{ $courses }}" :marital_statuses="{{ $marital_statuses }}"></member-show>
    </div>
@endsection
