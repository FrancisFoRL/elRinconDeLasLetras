@vite(['resources/js/app.js'])
<div class="container">
    <div class="row vh-100">
        <div class="col d-flex align-items-center justify-content-center">
            <div id="form" class="w-50 p-4">
                @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif

                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <h1>Checkout</h1>
                <div>
                    <p class="text-left">Direccion de envio</p>
                    <form action="{!!route('paymentStripe')!!}" class="mx-3">
                        <div class="form-group d-flex">
                            <div class="form-control-wrapper w-50">
                                <input type="text" class="form-control" id="nombre" placeholder=" " autocomplete="on">
                                <label for="nombre">Nombre</label>
                            </div>
                            <div class="form-control-wrapper w-50">
                                <input type="text" class="form-control" id="apellidos" placeholder=" "
                                    autocomplete="on">
                                <label for="apellidos">Apellidos</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrapper">
                                <input type="text" class="form-control" id="address" placeholder=" " autocomplete="on">
                                <label for="address">Direccion de envio</label>
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="form-control-wrapper w-50">
                                <label for="provincia">Provincia</label>
                                <select class="form-select" aria-label="Eliga un provincia" id="provincia">
                                    <option selected>--Eliga un provincia--</option>
                                    @foreach ($provincias as $provincia)
                                    <option value="{{$provincia}}">{{$provincia}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-control-wrapper w-50">
                                <input type="text" class="form-control" id="postal" autocomplete="on">
                                <label for="postal">Código Postal</label>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <div class="form-control-wrapper">
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                        autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="btnradio1"><img
                                            src="{{Storage::url('paypal-icon.png')}}" alt="Icono de Paypal"
                                            width="30px"> Paypal</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio2">Tarjeta <img
                                            src="{{Storage::url('tarjeta-de-credito.png')}}"
                                            alt="Icono de Tarjeta de Pago" width="30px"> </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-5" id="tarjeta-formulario">
                            <div class="card credit-card p-4">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <p class="fw-bold fst-italic">Débito</p>
                                        </div>
                                        {{-- <div class="col-12 my-2">
                                            <label for="" class="visually-hidden">Nombre del titular</label>
                                            <input class="card-number w-100" placeholder="Nombre del titular"></input>
                                        </div> --}}
                                        <div class="col-12 mb-2">
                                            <label for="" class="visually-hidden">Número de tarjeta</label>
                                            <input class="card-title w-100" placeholder="Número de tarjeta" name="card_no"></input>
                                        </div>
                                        <div class="col-10 mb-2 d-flex">
                                            {{-- <label for="" class="visually-hidden">Fecha de expiración</label>
                                            <input class="card-title me-3 w-50"
                                                placeholder="Fecha de expiración"></input> --}}
                                            <input class="card-title me-3 w-50"
                                                placeholder="Mes de expiración" name="expiracionMes"></input>
                                            <input class="card-title me-3 w-50"
                                                placeholder="Año de expiración" name="expiracionAnio"></input>
                                            <label for="" class="visually-hidden">CCV</label>
                                            <input class="card-title w-25" placeholder="CCV"></input>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{Storage::url('visa-logo.png')}}" alt="Icono de Tarjeta de Pago"
                                                width="100px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse mt-3">
                                <button class="btn btn-success" type="submit">Pagar</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group mt-5 d-flex justify-content-center" id="pagar-paypal">
                        <form action="{{route('requestpayment')}}" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
                                    <path
                                        d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z" />
                                </svg> Pagar con Paypal</button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>

<script>
    // Selecciona los elementos de radio
    const paypalRadio = document.getElementById('btnradio1');
    const tarjetaRadio = document.getElementById('btnradio2');

    // Selecciona el formulario de pago con tarjeta de crédito
    const tarjetaFormulario = document.getElementById('tarjeta-formulario');

    // Oculta el formulario de pago con tarjeta de crédito al inicio
    tarjetaFormulario.style.display = 'none';

    // Agrega un controlador de eventos para el cambio en los botones de radio
    paypalRadio.addEventListener('change', () => {
    tarjetaFormulario.style.display = 'none';
    });

    tarjetaRadio.addEventListener('change', () => {
    tarjetaFormulario.style.display = 'block';
    });
</script>

<style>
    body {
        background: linear-gradient(-45deg, #212121, #6D9886, #D9CAB3, #F6F6F6);
        background-size: 400% 400%;
        animation: change 10s ease-in-out infinite;
        font-family: Arial, Helvetica, sans-serif;
    }

    @keyframes change {
        0% {
            background-position: 0 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0 50%;
        }
    }

    #form {
        background: rgba(246, 246, 246, 0.41);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(246, 246, 246, 0.86);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control-wrapper {
        position: relative;
        padding-top: 10px;
    }

    .form-control-wrapper input.form-control {
        height: 50px;
        padding: 10px 20px;
        font-size: 16px;
        line-height: 28px;
        background-color: transparent;
    }

    .form-control-wrapper input.form-control:focus {
        border-bottom: 2px solid #007bff;
        box-shadow: none;
    }

    .form-control-wrapper label {
        position: absolute;
        top: 22px;
        left: 8px;
        font-size: 17px;
        transition: all 0.2s ease-out;
    }

    .form-control-wrapper input.form-control:focus+label,
    .form-control-wrapper input.form-control:not(:placeholder-shown)+label {
        top: -10px;
        font-size: 14px;
        color: #007bff;
    }

    .credit-card {
        border: 1px solid #ced4da;
        border-radius: 8px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 0 auto;
        background-color: #f8f9fa;
    }

    .credit-card img {
        max-width: 100%;
    }
</style>
