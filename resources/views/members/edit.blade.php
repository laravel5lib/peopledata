@extends('layouts.app')
@section('title')
    Editar miembro @parent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <member-edit :initial="{{ $member }}"></member-edit>
        </div>
    </div>
</div>
@endsection
