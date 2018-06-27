@extends('layouts.app')

@section('title')
    Crear un curso @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/courses" method="post">
                    {{ csrf_field() }}
                    @include('forms.text', ['field'=>'name', 'label'=>'Nombre','value'=>old('name',''),'placeholder'=>'Escriba aquí','help'=>'Escriba el nombre del curso a crear'])
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
@endsection
