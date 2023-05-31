<title>Contacto | ElRinconDeLasLetras</title>
<x-app-layout>
    <x-messages />
    <div class="container">
        <h2 class="text-center mt-4 display-6" style="font-family: Ubuntu">Contacto</h2>
        <hr>
        <div class="row p-3 pt-2 pt-md-4 text-center">
            <p class="fw-bold fs-3">¡Nos encanta escucharte!</p>
            <p class="fs-5">En El Rincón de las Letras, valoramos tu opinión y estamos ansiosos por atender cualquier
                pregunta,
                consulta o comentario que tengas. Nuestro equipo de atención al cliente está aquí para ayudarte en todo
                lo que necesites. ¡No dudes en ponerte en contacto con nosotros!</p>
        </div>
        <form action="{{route('contacto.send')}}" name="form" method="POST">
            @csrf
            <div class="border border-dark border-2 rounded-4 p-3 p-md-5 row mb-5 mx-1 mx-md-0" id="cont-form">
                <div class="col-12 col-md-6">
                    <label for="nombre" class="fw-bold fs-5">Indíquenos su nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="name"
                        value="{{ old('nombre') }}">
                    @error('nombre')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-6 mt-3 mt-md-0">
                    <label for="email" class="fw-bold fs-5">Correo electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email"
                        value="{{ old('email') }}">
                    @error('email')
                    <span class="text-danger">*{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 mt-4">
                    <div class="form-group">
                        <label for="contenido" class="fw-bold fs-5">Indiquenos su consulta:*</label>
                        <textarea class="form-control" id="contenido" name="contenido" class="contenido"
                            rows="10">{{ old('contenido') }}</textarea>
                        @error('contenido')
                        <span class="text-danger">*{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 mt-4 text-center">
                    <button type="submit" class="rounded-pill fw-bold" id="button">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
<x-footer />

<style>
    #cont-form input,
    #cont-form textarea {
        border: 2px solid #212121;
    }

    #button {
        background-color: #6D9886;
        border: 2px solid #212121;
        color: #212121;
        padding: 10px 30px 10px 30px;
    }

    #button:hover {
        background-color: transparent;
        box-shadow: 3px 3px 0 #6D9886;
        color: #212121;
    }

    @media(min-width:2500px) {
        #cont-form {
            margin-bottom: 5.4vw !important;
        }
    }
</style>
