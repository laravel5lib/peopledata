@component('mail::message')
# Hola {{ $user->getShortName() }}!

Ya se acerca el comienzo de las clases para este segundo semestre. 
Estás recibiendo este correo, porque te encuentras ya inscrito(a) en una clase, 
es probable que este registro lo hayas hecho tu directamente, o tu profesor del
último curso.

A continuación tienes la información del curso en el que estás inscrito(a).

@component('mail::panel')
    **{{ $course->name }}**  
    *Professor:* {{ $course->professor->name }}  
    *Horario:* {{ $course->dayName }}, {{ $course->hour }}  
    *Salón:* {{ $course->location }}
@endcomponent

@component('mail::button', ['url' => ''])
    Confirmar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
