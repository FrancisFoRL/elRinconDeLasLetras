@section('page-title')
Pedidos |
@endsection
<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                <x-nav-perfil />
            </div>
            <div class="col-12 col-lg-10">
                <div class="mx-auto m-4 p-4" id="contendor-princ">
                    <h2 class="display-6 mb-4">Mis Pedidos</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="fw-bold fs-5">
                                    <th>Nº Pedido</th>
                                    <th>Total Pagado</th>
                                    <th>Fecha de Pedido</th>
                                    <th>Mas Detalles sobre el Pedido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr class="fs-6">
                                    <td class="p-2 p-lg-3">{{$order->order_number}}</td>
                                    <td class="p-2 p-lg-3">{{$order->total_paid}} €</td>
                                    <td class="p-2 p-lg-3">{{$order->created_at}}</td>
                                    <td class="text-center">
                                        <button class="btn fw-bold pedido-details-btn rounded-pill" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#pedido-details-{{$order->id}}"
                                            aria-expanded="false" aria-controls="pedido-details-{{$order->id}}">
                                            <span class="d-none d-lg-block">Mas detalles sobre el pedido</span> <i
                                                class="fas fa-arrow-down px-1"></i>
                                        </button>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4" class="hidden-row">
                                        <div class="collapse py-4 px-5" id="pedido-details-{{$order->id}}">
                                            <!-- Contenido adicional del pedido -->
                                            <h3 class="fw-bold text-center text-lg-start">Detalles del pedido</h3>
                                            <hr>
                                            @foreach ($books as $book)
                                            @if($book->order_id == $order->id)
                                            <div class="row align-items-center">
                                                <div class="col-12 col-lg-3 text-center">
                                                    <img src="{{$book->image}}" alt="Portada {{$book->title}}"
                                                        class="img img-fluid rounded-3 border border-dark">
                                                </div>
                                                <div class="col-12 col-lg-3 text-center text-lg-start mt-3 mt-lg-0">
                                                    <p class="fs-5 fw-bold">{{$book->title}}</p>
                                                </div>
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <p> Número de unidades: {{$book->book_quantity}}</p>
                                                    <p>Precio por unidad: {{$book->price}}€</p>
                                                </div>
                                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                                    <p>Total: {{$book->price * $book->book_quantity}} €</p>
                                                </div>
                                            </div>
                                            <hr>
                                            @endif
                                            @endforeach
                                            <div class="d-flex flex-row-reverse">
                                                <p class="fs-3 fw-bold text-center text-lg-start">Total del pedido:
                                                    {{$order->total_paid}}€ Envio Incl.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.pedido-details-btn');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');

                if (icon.classList.contains('fa-arrow-down')) {
                    icon.classList.remove('fa-arrow-down');
                    icon.classList.add('fa-arrow-up');
                } else {
                    icon.classList.remove('fa-arrow-up');
                    icon.classList.add('fa-arrow-down');
                }
            });
        });
    });
</script>


<style>
    #contendor-princ {
        border: 2px solid #222222;
        border-radius: 15px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    h2 {
        font-family: 'Ubuntu', sans-serif;
    }

    .pedido-details-btn.active {
        background-color: red;
        color: #fff;
    }


    .table {
        border: 2px solid #212121;
    }

    .btn {
        background-color: #212121;
        color: #fff;
    }

    .btn:hover {
        border-color: #212121;
        color: #212121;
    }

    @media (max-width: 747px) {
        th {
            font-size: 14px;
        }

        td {
            font-size: 12px;
        }
    }
</style>
