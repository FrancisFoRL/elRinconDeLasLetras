@component('mail::message')
# Formulario de Contacto
## Enviado por:
{{ $nombre }}
## Email:
{{ $email }}
## Contenido:
>{{ $contenido }}
@endcomponent
