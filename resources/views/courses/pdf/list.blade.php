@extends('layouts.pdf')
@section('title')
    {{ $course->name }} :: Hoja de Clase @parent
@endsection

@section('content')
    <div class="container">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/logos/el-encuentro-168x100.png') }}" height="50" alt="El Encuentro con Dios" class="d-inline-block align-top"></td>
                <td style="text-align: right">
                    <div style="font-size: 1.5rem; color: #666;">Iglesia Cristiana El Encuentro con Dios</div>
                    <div style="color: #999;">Listado de estudiantes de <span style="font-size:1.2rem;font-weight: bold;color: #1c7430;">{{ $course->name }}</span></div>
                    <small><span style="font-weight: normal;color: #345474;">{{ $course->professor->name }} - <strong>{{ $course->period }}</strong></span> - <strong>${{ number_format($course->value,0,',','.') }}</strong></small>
                </td>
            </tr>
        </table>
        <hr>
    </div>
    @foreach($course->members as $member)
        <div style="border:1px solid #666;padding:3px;margin-bottom: -1px;">
            <table width="100%">
                <tr style="font-size:0.9rem;">
                    <td width="40%" style="border-right: 1px solid #666;">
                        <strong>{{ $member->name }}</strong><br>
                        <small><span style="color: #999;">{{ $member->phone }}</span></small>
                    </td>
                    <td width="15%" style="border-right: 1px solid #666;">
                        <small style="color: #999;">Recibo de caja</small>
                        <br>
                        &nbsp;
                    </td>
                    <td width="45%" style="">
                        <small style="color: #999;">Comentarios</small>
                        <br>
                        &nbsp;
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
    <hr>
    <div style="border:1px solid #666;padding:5px; margin-top:10px;margin-bottom: -1px; text-align: right;padding-right: 100px">
        Total libros entregados: 
    </div>
@endsection
