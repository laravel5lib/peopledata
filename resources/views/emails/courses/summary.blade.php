@component('mail::message')
# Hola {{ $professor->first_name }}!

Estas recibiendo este correo porque tienes una clase asignada para este semestre 2019-1!   

A continuación tienes la lista de personas inscritas en el curso.

@component('mail::table')
| Nombre       | Teléfono         | Email  |
| ------------- | ------------- | -------- |
@foreach($course->members as $member)
| {{ $member->first_name . ' ' . $member->last_name }} | {{ $member->phone }} | {{ $member->email }} |
@endforeach
@endcomponent

Si tienen alguna inquietud, puedes contactar a **Sandra Ramos** al correo electrónico: *sramos7785@gmail.com*, o al teléfono: *3176489132*  

Puedes revisar o cambiar la inscripción de tus estudiantes haciendo click en el botón a continuación.

@component('mail::button', ['url' => $url])
    Revisar clase
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
