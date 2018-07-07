@component('mail::message')
# Hola {{ $member->first_name }}!

En el **2018-1** inscribiste un curso pero por alguna razón no pudiste tomarlo o terminarlo satisfactoriamente.

Ya se acerca el comienzo de las clases para este segundo semestre.  

Desde el ministerio de Educación Cristiana, esperamos que continúes tu proceso de crecimiento, 
y por esto te estamos recomendando tomar el siguiente curso:

@component('mail::panel')
## {{ $course_name }}  
Es probable que hayan varios horarios disponibles.    
@endcomponent

Te invitamos a que hagas tu pre-inscripción en línea de manera muy sencilla haciendo click en el siguiente botón.

@component('mail::button', ['url' => $url])
    Ver cursos disponibles
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
