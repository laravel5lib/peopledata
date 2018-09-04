@extends('layouts.app')

@section('title')
    Ministerios @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="card mb-2">
                    <div class="card-body">
                        @foreach($ministries as $ministry)
                        <div class="row">
                            <div class="col-md">
                                {{ $ministry->name }}
                            </div>
                            <div class="col-md">
                                <a href="/ministries/{{ $ministry->id }}" class="btn btn-primary">Ver</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
