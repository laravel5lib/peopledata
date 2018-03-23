@extends('layouts.app')

@section('title')
    Lista de miembros @parent
@endsection

@section('content')
    <div class="container">
        @foreach($members->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $member)
                    <div class="col-md">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <a href="/members/{{ $member->id }}">
                                        @if(($media = $member->firstMedia('avatar')) && $media->aggregate_type == 'image')
                                            <img class="card-img-top rounded-circle" src="/img/public/{{ $media->getDiskPath() }}?w=240&h=240&fit=crop" alt="{{ $member->name }}">
                                        @else
                                            <img class="card-img-top rounded-circle" src="{{ $member->avatar }}" alt="{{ $member->name }}">
                                        @endif
                                        </a>
                                        <br><small>{{ $member->id }}</small>
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text">{{ $member->updated_at }}</p>
                                        <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('members.updateinfo', ['id' => $member->id]) }}" class="btn btn-primary">Actualizar</a>
                                        <a href="{{ route('members.edit', ['member' => $member->id]) }}" class="btn btn-success">Editar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
