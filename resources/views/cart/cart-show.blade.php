<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1>Carrito de compra</h1>
            @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif
            @if(Cart::count()>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio unitario</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::content() as $book)
                    <tr>
                        <td>
                            <img src="{{$book->model->image}}" alt="Portada del libro {{$book->model->title}}">
                        </td>
                        <td>{{$book->model->title}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <a class="btn btn-outline-secondary" type="button"
                                    wire:click.prevent='disminuirCantidad("{{$book->rowId}}")'>-</a>
                                <div class="mx-2">{{$book->qty}}</div>
                                <a class="btn btn-outline-secondary" type="button"
                                    wire:click.prevent='aumentarCantidad("{{$book->rowId}}")'>+</a>
                            </div>
                        </td>
                        <td>{{$book->model->price}}€</td>
                        <td>{{$book->model->price * $book->qty}}€</td>
                        <td>
                            <button class="btn btn-danger" type="button"
                                wire:click.prevent='eliminar("{{$book->rowId}}")'>Eliminar</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <p>Subtotal: {{$subtotal}}€</p>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-primary">Comprar</a>
            <a href="/" class="btn btn-outline-secondary">Seguir comprando</a>
        </div>
    </div>
</div>
@else
<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-12 text-center">
        <p style="font-size: 40px; margin-top: 100px; font-weight: bold">Tu carrito de la compra está vacío</p>
        <div class="d-flex justify-content-center align-items-center">
            <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_z9agdrw6.json"
                background="transparent" speed="1" style="width: 500px; height: 500px;" loop autoplay>
            </lottie-player>
        </div>
    </div>
</div>
@endif
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
