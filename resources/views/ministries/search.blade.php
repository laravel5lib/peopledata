@extends('layouts.app')

@section('title')
    Buscar personas @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Buscar personas</h5>
            <div class="card-body">
                <members-search add_url="/ministries/{{ $ministry->id }}/add/"></members-search>
            </div>
        </div>
    </div>
@endsection
