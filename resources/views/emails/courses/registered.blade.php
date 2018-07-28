@component('mail::message')
# Hola {{ $member->first_name }}!

Ya se acerca el comienzo de las clases para este segundo semestre.   
*-A partir del domingo 5 de agosto-*   
Estás recibiendo este correo, porque **te encuentras ya inscrito(a)** en una clase, 
es probable que este registro lo hayas hecho tu directamente, o tu profesor del
último curso.

A continuación tienes la información del curso en el que estás inscrito(a).

@component('mail::panel')
## {{ $course->name }}  
**Professor:** {{ $course->professor->name }}  
**Horario:** {{ $course->dayName }}, {{ $course->hour }}    
**Salón:** {{ $course->location }}  
**Valor:** ${{ number_format($course->value,0,',','.') }}
@endcomponent

Si tienen alguna inquietud, puedes contactar a **Sandra Ramos** al correo electrónico: *sramos7785@gmail.com*, o al teléfono: *3176489132*  

Si aún no has cancelado tu inscripción, lo puedes hacer el domingo acercándote a las mesas de inscripción.    

Puedes revisar o cambiar tu inscripción haciendo click en el botón a continuación.

@component('mail::button', ['url' => $url])
    Revisar cursos
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
