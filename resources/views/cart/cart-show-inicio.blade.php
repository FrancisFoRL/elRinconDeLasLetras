<!-- Offcanvas Shopping Card -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title" id="offcanvasRightLabel">Mi Cesta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
        @endif
        @if (Cart::count()>0)
        <div class="table-responsive">
            <table id="table">
                <thead>
                    <tr>
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
                        <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">Subtotal:</div>
            <div class="col-6 text-end">{{$subtotal}}</div>
        </div>
        <div class="row">
            <div class="col-6">Shipping:</div>
            <div class="col-6 text-end">$5.00</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">Total:</div>
            <div class="col-6 text-end">$64.94</div>
        </div>
        <hr style="background-color: #D9D9D9; height: 4px; border-radius: 5px">
        @endif
        <a href="{{ route('cart') }}">
            <div class="d-grid gap-2 position-absolute bottom-0 start-0 end-0 mb-3 mx-3">
                <button class="btn btn-lg" type="button" id="buttonCart">Ir a caja</button>
            </div>
        </a>
    </div>
</div>
