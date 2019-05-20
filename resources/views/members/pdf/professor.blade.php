@extends('layouts.pdf')
@section('title')
    {{ $member->name }} :: Hoja de Profesor @parent
@endsection

@section('content')
    <div class="container">
        <table width="100%">
            <tr>
                <td><img src="{{ asset('images/logos/el-encuentro-168x100.png') }}" height="50" alt="El Encuentro con Dios" class="d-inline-block align-top"></td>
                <td style="text-align: right">
                    <div style="font-size: 1.5rem; color: #666;">Iglesia Cristiana El Encuentro con Dios</div>
                    <div style="color: #999;">Formato de actualización de datos de <span style="font-size:1.2rem;font-weight: bold;color: #1c7430;">Profesor</span></div>
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
        <div style="font-size: 1.8rem;margin-bottom: 0px; font-weight: 500;color: #0c5460;">Cursos dictados anteriormente</div>
        <div style="font-size: 1rem;margin-bottom: 10px; font-weight: 500;color: #666;">Revise y agregue la información de todos cursos dictados en la iglesia</div>
        @foreach($courses as $course)
            <div style="border:1px solid #666;padding:10px;margin-bottom: 10px;">
                <table width="100%">
                    <tr>
                        <td width="50%">{{ $course->name }}</td>
                        <td width="25%">{{ $course->period }}</td>
                        <td width="25%">{{ $course->members()->count() }} estudiantes</td>
                    </tr>
                </table>
                
            </div>
        @endforeach
        @for($i=$courses->count();$i<10;$i++)
            <div style="border:1px solid #666;padding:10px;margin-bottom: 10px;">
                <br>
            </div>
        @endfor
    </div>
@endsection
