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
            @if($member->pivot->payment > 0 || ($member->pivot->status != 'didnt_start' && $member->pivot->status != 'didnt_finish') )
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $days[$course->day] }}</td>
                    <td>{{ $course->hour }}</td>
                    <td>{{ optional($course->professor)->first_name . ' ' . optional($course->professor)->last_name }}</td>
                    <td>{{ $member->first_name . ' ' . $member->last_name }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->pivot->payment }}</td>
                    <td>{{ $options[$member->pivot->status] }}</td>
                </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>