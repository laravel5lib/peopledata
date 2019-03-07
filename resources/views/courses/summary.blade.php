<div class="card mb-2 {{ $course->color }} text-white">
    <div class="card-body">
        <div class="float-right">
            <span class="badge badge-light">${{ number_format($course->value,0,',','.') }}</span><br>
            @if($course->members->whereNotIn('pivot.status',['didnt_start','didnt_finish'])->count())
                <span class="badge badge-dark">{{ $course->members->whereNotIn('pivot.status',['didnt_start','didnt_finish'])->count() }} estudiantes</span>
            @endif
        </div>
        <h5 class="card-title"><a class="text-white" href="/courses/{{ $course->id }}/students">{{ $course->name }}</a></h5>
        @if($course->professor)
            <small class="">{{ $course->professor->first_name }} {{ $course->professor->last_name }}</small>
        @endif
        <p class="card-text">
            @if($course->hour != '12:00 am')
                <span>{{ $course->hour }}</span>, 
            @endif
            {{ $course->location }}
        </p>
    </div>
</div>