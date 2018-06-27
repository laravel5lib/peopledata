<div class="card mb-2">
    <div class="card-body">
        <h5 class="card-title"><a href="/courses/{{ $course->id }}/students">{{ $course->name }}</a></h5>
        @if($course->professor)
            <small class="text-info">{{ $course->professor->first_name }} {{ $course->professor->last_name }}</small>
        @endif
        <p class="card-text">{{ $course->hour }}<br>
            {{ $course->location }}<br>
            @if($course->value)
                <span class="text-muted">${{ number_format($course->value,0,',','.') }}</span> <br>
            @endif
            @if($course->members->count())
            <span class="badge badge-info">{{ $course->members->count() }} estudiantes</span>
            @endif
        </p>
    </div>
</div>