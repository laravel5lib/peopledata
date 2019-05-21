@extends('layouts.pdf')
@section('title')
    {{ $member->name }} :: Hoja de Profesor @parent
@endsection

@section('content')
    @include('members.pdf.member_professor')
@endsection
