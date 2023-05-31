@section('page-title')
Mapa Web |
@endsection
<x-app-layout>
    <div class="container">
        <h2 class="text-center mt-4 display-6" style="font-family: Ubuntu">Mapa Web</h2>
        <hr>
        <div class="p-5 my-5 border border-dark border-2 rounded-4" id="map-container">
            <ul class="sitemap-list">
                <li class="fs-5"><a href="{{ route('inicio') }}">El Rincón de las Letras</a></li>
                <li class="fs-5">Búsqueda</li>
                <li class="fs-5">
                    Mostrar Libro
                    <ul class="sitemap-sublist">
                        <li class="fs-6"><a href="libros/man-and-superman">Man and Superman</a></li>
                        <li class="fs-6"><a href="libros/headlong-hall">Headlong Hall</a></li>
                        <li>...</li>
                    </ul>
                </li>
                <li class="fs-5">
                    Mostrar Categoría
                    <ul class="sitemap-sublist">
                        <li class="fs-6"><a href="categorias/language-arts-disciplines">Language Arts Disciplines</a></li>
                        <li class="fs-6"><a href="categorias/psychology">Psychology</a></li>
                        <li>...</li>
                    </ul>
                </li>
                <li class="fs-5">
                    Perfil de usuario
                    <ul class="sitemap-sublist">
                        <li class="fs-6"><a href="{{route('profile.show')}}">Datos de usuario</a></li>
                        <li class="fs-6"><a href="{{ route('pedidos') }}">Pedidos</a></li>
                        <li class="fs-6"><a href="{{ route('opiniones') }}">Reseñas</a></li>
                    </ul>
                </li>
                <li class="fs-5"><a href="{{ route('cart') }}">Carrito de Compra</a></li>
                <li class="fs-5"><a href="{{ route('wishlist') }}">Lista de Deseos</a></li>
                <li class="fs-5"><a href="{{ route('sobrenost') }}">Sobre Nosotros</a></li>
                <li class="fs-5"><a href="{{ route('contacto.show') }}">Contacto</a></li>
                <li class="fs-5"><a href="{{ route('info-legal') }}">Información Legal</a></li>
                <li class="fs-5"><a href="{{ route('privacidad') }}">Política de Privacidad</a></li>
            </ul>
        </div>
    </div>
</x-app-layout>
<x-footer/>
<style>

    .sitemap-list li a{
        text-decoration: none;
        color: #8B0000;
    }

    .sitemap-list li a:hover{
        text-decoration: underline;
        text-underline-offset: 6                                            px;
        color: #800080;
        text-decoration-color: #8B0000;
    }

    @media(min-width:2500px) {
        #map-container {
            margin-bottom: 5.7vw !important;
        }
    }
</style>
