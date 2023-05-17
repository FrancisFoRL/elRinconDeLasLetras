<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                <x-nav-perfil />
            </div>
            <div class="col-12 col-lg-10">
                <div class="mx-auto m-4 p-4" id="contendor-princ">
                    <h2 class="display-6 mb-4">Mis Pedidos</h2>
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
                            <tr>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->total_paid}}</td>
                                <td>{{$order->created_at}}</td>
                                <td class="text-center">
                                    <button class="btn fw-bold pedido-details-btn rounded-pill" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#pedido-details-{{$order->id}}"
                                        aria-expanded="false" aria-controls="pedido-details-{{$order->id}}">
                                        Mas detalles sobre el pedido <i class="fas fa-arrow-down px-1"></i>
                                    </button>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="3" class="hidden-row">
                                    <div class="collapse" id="pedido-details-{{$order->id}}">
                                        <!-- Contenido adicional del pedido -->
                                        <!-- Puedes agregar aquí los detalles del pedido -->
                                        <p>Detalles del pedido: {{$order->id}}</p>
                                        <p>Otro detalle del pedido</p>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


            {{-- <div class="mx-auto m-4 p-4" id="contendor-princ">
                <h2 class="display-6 mb-4">Mis Pedidos</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="fw-bold fs-5">
                            <th>Nº Pedido</th>
                            <th>Total Pagado</th>
                            <th>Fecha de Pedido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->order_number}}</td>
                            <td>{{$order->total_paid}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> --}}
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
</style>
