<!-- Offcanvas Shopping Card -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h1 class="offcanvas-title" id="offcanvasRightLabel">Mi Cesta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (Cart::count()>0)
        @foreach (Cart::content() as $book)
        <div class="row p-2">
            <div class="col-4 text-center">
                <img src="{{$book->model->image}}" alt="" class="border border-light rounded" width="95px"
                    height="130px">
            </div>
            <div class="col-7 pt-2">
                <p class="fw-bold fs-5 p-ellipsis">{{$book->model->title}}</p>
                <p class="p-ellipsis">Unidades: {{$book->qty}}</p>
                <p class="fs-5 p-ellipsis">{{$book->model->price * $book->qty}}€</p>
            </div>

            <hr class="mt-3">
        </div>
        @endforeach

        <div class="row mt-3">
            <div class="col-6">Subtotal:</div>
            <div class="col-6 text-end">{{$subtotal}}€</div>
        </div>
        <div class="row">
            <div class="col-6">Envio:</div>
            <div class="col-6 text-end">4,99€</div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">Total:</div>
            <div class="col-6 text-end">{{$subtotal + 4.99}}€</div>
        </div>
        <hr style="background-color: #D9D9D9; height: 4px; border-radius: 5px; margin-bottom:70px;">
        @else
        <div class="mt-5 text-center">
            <img src="https://cdn.pccomponentes.com/Unilae/svg/lensPickingPointsNoPostalCodeFound.svg" alt=""
                width="150px">
            <h2 class="mt-4">Tu carrito está vacío</h2>
        </div>
        @endif
        <a href="{{ route('cart') }}">
            <div class="d-grid gap-2 position-absolute bottom-0 start-0 end-0 mb-3 mx-3">
                <button class="btn btn-lg" type="button" id="buttonCart">Ir a caja</button>
            </div>
        </a>
    </div>
</div>

<style>
    .p-ellipsis {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
