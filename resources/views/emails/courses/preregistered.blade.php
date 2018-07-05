@component('mail::message')
# Hola

Te encuentras pre-inscrito(a) en el siguiente curso:

@component('mail::panel')
    {{ $course->name }}  
    {{ $course->professor->name }}
    {{ $course->dayName }}
    {{ $course->hour }}
    {{ $course->location }}
@endcomponent

@component('mail::button', ['url' => ''])
    Confirmar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
