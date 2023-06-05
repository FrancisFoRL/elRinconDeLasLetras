<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $datos = [];

    /**
     * Se crea una nueva instancia de mensaje.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos; //Se da el valor de datos a la varibale de la clase Contacto
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->datos['email'], $this->datos['nombre']), //Se crea una nueva intancia de Address y se le añade el email y nombre proporcionados
            subject: 'Formulario de Contacto',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'mail.index', //Se usa la plantilla de markdown que se encuentra en mail
            with: [
                'nombre' => $this->datos['nombre'], //Se pasa el campo nombre a la plantilla
                'email' => $this->datos['email'], //Se pasa el campo email a la plantilla
                'contenido' => $this->datos['contenido'] //Se pasa el campo contenido a la plantilla
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
