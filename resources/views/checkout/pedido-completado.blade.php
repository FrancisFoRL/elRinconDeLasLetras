<x-app-layout>
    <div class="d-flex justify-content-center mt-5">
        <h2 class="display-4 fw-bold">Pedido Completado</h2>
    </div>
    <div class="d-flex justify-content-center mt-2">
        <p class="fs-5" id="pedido-text">Puedes ver el pedido en el apartado de <a href="/" class="fw-bold" style="color:#DC143C;">"Mis pedidos"</a></p>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_k10ku8at.json"
            background="transparent" speed="1" style="width: 65vw; height: 25vw; min-height: 600px; min-width: 370px;" autoplay>
        </lottie-player>
    </div>
</x-app-layout>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<style>
    @media (max-width: 490px) {
        #pedido-text{
            font-size: 14px !important;
        }
    }
</style>
