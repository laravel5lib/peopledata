@extends('layouts.pdf')
@section('title')
    {{ $member->name }} :: Hoja de Estudiante @parent
@endsection

@section('content')
    <div class="container">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/logos/el-encuentro-168x100.png') }}" height="50" alt="El Encuentro con Dios" class="d-inline-block align-top"></td>
                <td style="text-align: right">
                    <div style="font-size: 1.5rem; color: #666;">Iglesia Cristiana El Encuentro con Dios</div>
                    <div style="color: #999;">Formato de actualización de datos de <span style="font-size:1.2rem;font-weight: bold;color: #9c6ade;">Estudiante</span></div>
                </td>
            </tr>
        </table>
        <hr>
        <div>
            <div>
                <table width="100%">
                    <tr>
                        <td rowspan="2"><img src="{{ url($member->image)  }}" alt="{{ $member->name }}" style="border-radius: 60px;" width="120"></td>
                        <td colspan="2">
                            <div style="font-size: 2rem"><strong>{{ $member->name }}</strong></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>Email:</strong> {{ $member->email }}</div>
                            <div><strong>Profesión:</strong> {{ $member->profession }}</div>
                            <div><strong>Situación laboral:</strong> {{ $member->working }}</div>
                            <div><strong>Empresa:</strong> {{ $member->company?$member->company:'______________________' }}</div>
                        </td>
                        <td valign="top">
                            <div><strong>Género:</strong> {{ $member->gender == 'M'?'Masculino':'Femenino' }}</div>
                            <div><strong>Teléfono:</strong> {{ $member->phone }}</div>
                            <div><strong>F. Nacim.:</strong> {{ $member->birthdate }}</div>
                            <div><strong>Estado Civil:</strong> {{ $marital_statuses[$member->marital_status_id] }}</div>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td width="50%" style="border: 1px solid #999;text-align: center;color: #666;"><strong>Fecha de inicio en el Cristianismo:</strong><br>
                            {{ $member->date_christ }}&nbsp;
                        </td>
                        <td width="50%" style="border: 1px solid #999;text-align: center;color: #666;"><strong>Fecha de llegada a El Encuentro con Dios:</strong><br>
                            {{ $member->date_elencuentro }}&nbsp;
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div style="font-size: 1.8rem;margin-bottom: 0px; font-weight: 500;color: #0c5460;">Cursos realizados o en curso</div>
        <div style="font-size: 1rem;margin-bottom: 10px; font-weight: 500;color: #666;">Revise y agregue la información de todos cursos tomados en la iglesia</div>
        <div style="background-color: #c3e6cb;color:#155724;padding: 10px;">Nivel 1</div>
        @foreach($courses as $course)
            @if($course->category == 'Nivel 1')
                <div style="border:1px solid #666;padding:3px;margin-bottom: 3px;">
                    <table width="100%">
                        <tr>
                            <td width="80%">
                                <strong>{{ $course->name }}</strong><br>
                                <small><span style="color: #999;">Professor:</span> {{ $course->professor? $course->professor->name: '__________________________' }}</small>
                            </td>
                            <td width="20%">
                                <small style="color: #999;">Periodo:</small>
                                <br>
                                <span>{{ $course->period != '0-Anteriores'?$course->period:'_______________' }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        <div style="background-color: #c3e6cb;color:#155724;padding: 10px;">Nivel 2</div>
        @foreach($courses as $course)
            @if($course->category == 'Nivel 2')
                <div style="border:1px solid #666;padding:3px;margin-bottom: 3px;">
                    <table width="100%">
                        <tr>
                            <td width="80%">
                                <strong>{{ $course->name }}</strong><br>
                                <small><span style="color: #999;">Professor:</span> {{ $course->professor? $course->professor->name: '__________________________' }}</small>
                            </td>
                            <td width="20%">
                                <small style="color: #999;">Periodo:</small>
                                <br>
                                <span>{{ $course->period != '0-Anteriores'?$course->period:'_______________' }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        <div style="background-color: #c3e6cb;color:#155724;padding: 10px;">Nivel 3</div>
        @foreach($courses as $course)
            @if($course->category == 'Nivel 3')
                <div style="border:1px solid #666;padding:3px;margin-bottom: 3px;">
                    <table width="100%">
                        <tr>
                            <td width="80%">
                                <strong>{{ $course->name }}</strong><br>
                                <small><span style="color: #999;">Professor:</span> {{ $course->professor? $course->professor->name: '__________________________' }}</small>
                            </td>
                            <td width="20%">
                                <small style="color: #999;">Periodo:</small>
                                <br>
                                <span>{{ $course->period != '0-Anteriores'?$course->period:'_______________' }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        <div style="background-color: #c3e6cb;color:#155724;padding: 10px;">Otros</div>
        @foreach($courses as $course)
            @if($course->category == 'Otros')
                <div style="border:1px solid #666;padding:3px;margin-bottom: 3px;">
                    <table width="100%">
                        <tr>
                            <td width="80%">
                                <strong>{{ $course->name }}</strong><br>
                                <small><span style="color: #999;">Professor:</span> {{ $course->professor? $course->professor->name: '__________________________' }}</small>
                            </td>
                            <td width="20%">
                                <small style="color: #999;">Periodo:</small>
                                <br>
                                <span>{{ $course->period != '0-Anteriores'?$course->period:'_______________' }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            @endif
        @endforeach
        <div style="background-color: #c3e6cb;color:#155724;padding: 10px;">Agregue a continuación los cursos tomados que no estan en este perfil</div>
        @php
        $max = 21;
        if($courses->count() <=1)$max = 21;
        @endphp
        @for($i = $courses->count();$i<$max;$i++)
            <div style="border:1px solid #666;padding:5px;margin-bottom: 3px;">
                <table width="100%">
                    <tr>
                        <td width="80%">
                            <strong><span style="color: #999;">Curso:</span></strong><br>
                            <small><span style="color: #999;">Professor:</span></small>
                        </td>
                        <td width="20%">
                            <small style="color: #999;">Periodo:</small>
                            <br>
                            &nbsp;
                        </td>
                    </tr>
                </table>
            </div>
        @endfor
        {{--        @for($i=$courses->count();$i<10;$i++)--}}
        {{--            <div style="border:1px solid #666;padding:10px;margin-bottom: 10px;">--}}
        {{--                <br>--}}
        {{--            </div>--}}
        {{--        @endfor--}}
    </div>
@endsection
