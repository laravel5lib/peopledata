<table>
    <thead>
    <tr>
        <th>Clase</th>
        <th>Día</th>
        <th>Hora</th>
        <th>Profesor</th>
        <th>Estudiante</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Pago</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($courses as $course)
        @foreach($course->members as $member)
{{--            @if( !count($status) || (count($status) && in_array($member->pivot->status, $status)) )--}}
                <tr>
{{--                    <td>{{ $course->name }}</td>--}}
{{--                    <td>{{ ($course->day && isset($days[$course->day])) ? $days[$course->day] : '' }}</td>--}}
                    <td>-</td>
{{--                    <td>{{ $course->hour }}</td>--}}
{{--                    <td>{{ optional($course->professor)->first_name . ' ' . optional($course->professor)->last_name }}</td>--}}
{{--                    <td>{{ $member->first_name . ' ' . $member->last_name }}</td>--}}
{{--                    <td>{{ $member->phone }}</td>--}}
{{--                    <td>{{ $member->email }}</td>--}}
{{--                    <td>{{ $member->pivot->payment }}</td>--}}
{{--                    <td>{{ $options[$member->pivot->status] }}</td>--}}
                </tr>
{{--            @endif--}}
        @endforeach
    @endforeach
    </tbody>
</table>