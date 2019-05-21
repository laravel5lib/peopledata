@extends('layouts.pdf')
@section('title')
    {{ $member->name }} :: Hoja de Estudiante @parent
@endsection

@section('content')
    @include('members.pdf.member')
@endsection
