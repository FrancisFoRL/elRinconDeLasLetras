<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShowContacto extends Controller
{
    public function index(){
        return view('contacto.show-contacto');
    }

    public function send(Request $request)
    {
        //Se comprueba que los datos en el formulario estan correctamente
        $request->validate([
            'nombre' => ['required', 'string', 'min:3'],
            'contenido' => ['required', 'string', 'min:10'],
            'email' => ['required', 'email', 'min:3']
        ]);
        try {
            //Se crea una instancia de la clase ContactoMailable y se le envía al correo electrónico especificado ('contacto@elrincondelasletras.com') utilizando Mail.
            Mail::to('contacto@elrincondelasletras.com')->send(new ContactoMailable($request->all()));
            return redirect()->route('contacto.show')->with('email-send', 'Error al enviar el email');
        } catch (Exception $e) {
            //Se redirige al usuario a la ruta de contacto en caso de error.
            return redirect()->route('contacto.show')->with('email-error', 'Error al enviar el email');
        }
    }
}
