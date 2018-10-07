@component('mail::message')
# Mensaje de: {{ $messageFrom->name }}

{{ $messageContent }}


---  

{{ config('app.name') }}
@endcomponent
