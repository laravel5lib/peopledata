@extends('layouts.app')

@section('title')
    Ministerios @parent
@endsection

@section('content')
    <div class="modal fade" id="newGroupModal" tabindex="-1" role="dialog" aria-labelledby="newGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Escribe un nombre">
                        <small id="nameHelp" class="form-text text-muted">El nombre del grupo a crear</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Crear Grupo</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Listado de mujeres</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        En este momento hay <strong>{{ $ministry->members()->count() }}</strong> mujeres registradas.
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" data-toggle="modal" data-target="#newGroupModal" class="btn btn-primary">Agregar Grupo</button>
                        <a href="/ministries/{{ $ministry->id }}/search" class="btn btn-primary">Agregar Mujer</a>
                    </div>
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
