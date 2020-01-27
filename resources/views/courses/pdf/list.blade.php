@extends('layouts.pdf')
@section('title')
    {{ $course->name }} :: Hoja de Clase @parent
@endsection

@section('content')
    @foreach($course->members as $member)
        <div style="border:1px solid #666;padding:3px;margin-bottom: 3px;">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <strong>{{ $member->name }}</strong><br>
                        <small><span style="color: #999;">{{ $member->phone }}</span></small>
                    </td>
                    <td width="50%">
                        <small style="color: #999;">Recibo de caja:</small>
                        <br>
                        <span>{{ '_______________' }}</span>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
@endsection
