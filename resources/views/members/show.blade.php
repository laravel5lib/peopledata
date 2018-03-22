@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <member-show :id="{{ $member->id }}"></member-show>
        </div>
    </div>
</div>
@endsection
