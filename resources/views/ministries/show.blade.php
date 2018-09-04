@extends('layouts.app')

@section('title')
    Ministerios @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Listado de mujeres</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        En este momento hay <strong>{{ $ministry->members()->count() }}</strong> mujeres registradas.
                    </div>
                    <div class="col-md-6 text-right"><a href="/ministries/{{ $ministry->id }}/search" class="btn btn-primary">Agregar mujer</a></div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row text-center">
                        <div class="col-md-10"><strong>Nombre</strong></div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </li>
                @forelse($ministry->members()->orderBy('first_name')->get() as $member)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-1 text-center">
                                <img src="{{ $member->image}} " alt="{{ $member->name}}" class="rounded-circle img-fluid img-thumbnail mb-1" width="100">
                            </div>
                            <div class="col-md-9">
                                <a href="/ministries/{{ $ministry->id }}/edit/{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</a><br>
                                <small class="text-muted">{{ $member->email }}</small>
                                <br>
                                <small class="text-muted">Tel: {{ $member->phone }}</small>
                            </div>
                            <div class="col-md-2 text-center">
                                <a href="/ministries/{{ $ministry->id }}/del/{{ $member->id }}" class="btn btn-danger btn-sm" ><i class="fal fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">
                        No hay mujeres
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
