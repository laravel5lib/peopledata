@extends('layouts.app')

@section('title')
    Editar curso @parent
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header text-white bg-info">Editar la información básica de un curso</h5>
            <div class="card-body">
                <form action="/courses/{{ $course->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <div class="row">
                        <div class="col-md-6">
                            @include('forms.text', ['field'=>'name', 'label'=>'Nombre','placeholder'=>'Escriba aquí','help'=>'Escriba el nombre del curso','value'=>old('name',$course->name)])
                            @include('forms.textarea', ['field'=>'description', 'label'=>'Descripción','placeholder'=>'Escriba aquí','help'=>'Descripción corta del curso','value'=>old('description',$course->description)])
                            @include('forms.select', ['field'=>'ministry_id', 'label'=>'Ministerio','help'=>'Ministerio al que pertenece este curso','value'=>old('ministry_id',$course->ministry_id), 'options'=>\App\Ministry::orderBy('name')->get()->pluck('name','id')->toArray()])
                            @include('forms.select', ['field'=>'category', 'label'=>'Nivel','help'=>'Nivel dentro de la ruta de educación','value'=>old('category',$course->category), 'options'=>$categories])
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Profesor</label><br>
                                @if($course->professor)
                                    {{ $course->professor->first_name }} {{ $course->professor->last_name }}<br>
                                    <a href="/courses/{{ $course->id }}/professor" class="btn btn-sm btn-success">Cambiar profesor</a>
                                    <a href="/courses/{{ $course->id }}/remove-professor" class="btn btn-sm btn-danger">Quitar profesor</a>
                                @else
                                    <a href="/courses/{{ $course->id }}/professor" class="btn btn-sm btn-success">Agregar profesor</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <div class="row m-0">
                                    @foreach($colors as $color)
                                        <div class="col-2 {{ $color }} text-white p-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="color" id="color_{{ $color }}" value="{{ $color }}" {{ $color==$course->color?'checked':'' }}>
                                                <label class="form-check-label" for="color_{{ $color }}">
                                                    <small>{{ $color }}</small>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4">
                            @include('forms.text', ['field'=>'location', 'label'=>'Salón','placeholder'=>'Escriba aquí','help'=>'En donde se llevarán a cabo las reuniones','value'=>old('location',$course->location)])
                        </div>
                        <div class="col-md-4">
                            @include('forms.select', ['field'=>'day', 'label'=>'Dia de clase','help'=>'Día de la semana en la que dará la clase','value'=>old('day',$course->day), 'options'=>['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado']])
                        </div>
                        <div class="col-md-4">
                            @include('forms.text', ['field'=>'hour', 'label'=>'Hora de clase','placeholder'=>'HH:MM','help'=>'Hora de la clase','value'=>old('hour',$course->hour)])
                        </div>
                        <div class="col-md-4">
                            @include('forms.select', ['field'=>'status', 'label'=>'Estado','help'=>'Estado del curso','value'=>old('status',$course->status), 'options'=>['open'=>'Abierto','closed'=>'Cerrado']])
                        </div>
                        <div class="col-md-4">
                            @include('forms.text', ['field'=>'period', 'label'=>'Periodo','placeholder'=>'Escriba aquí','help'=>'Periodo en el que se da este curso','value'=>old('period',$course->period)])
                        </div>
                        <div class="col-md-4">
                            @include('forms.text', ['field'=>'value', 'label'=>'Valor del curso','placeholder'=>'0','help'=>'Costo del material del curso','value'=>old('value',$course->value),'prepend'=>'$'])
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="/courses/{{ $course->id }}/students" class="btn btn-info">Lista de Estudiantes</a>
                    <button type="cancel" class="btn btn-secondary">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
