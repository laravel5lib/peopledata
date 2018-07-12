@component('mail::message')
# Hola {{ $member->first_name }}!

Ya se acerca el comienzo de las clases para este segundo semestre, y *aún* no estás inscrit@ en ningún curso.

Desde el ministerio de Educación Cristiana, esperamos que continúes con tu proceso de crecimiento, 
y por esto esperamos que te inscribas en alguno de los cursos que tenemos disponibles para ti.

Puedes hacer tu pre-inscripción en línea de manera muy sencilla haciendo click en el siguiente botón.

@component('mail::button', ['url' => $url])
    Ver cursos disponibles
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
