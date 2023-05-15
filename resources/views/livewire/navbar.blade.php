<nav class="navbar navbar-expand-sm bg-body-tertiary d-none d-lg-block" id="navPrincipal">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="{{route('inicio')}}">
                <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" id='logo' width="50" height="50"
                    class="me-4">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contactanos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre nosotros</a>
                </li>
            </ul>
            <div class="d-flex mx-auto justify-md-content-center">
                <div class="input-group">
                    <form action="{{route('search')}}" method="GET">
                        @csrf
                        <input class="form-control rounded-pill" name="titulo" id="inputSearch" type="search" placeholder="Buscar" aria-label="Search">
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('search-form').addEventListener('submit', function(event) {
                    var tituloInput = document.getElementById('inputSearch');
                    if (!tituloInput.value.trim()) {
                        event.preventDefault();
                    }
                });
            </script>

            <ul class="navbar-nav ms-auto me-2 align-items-center">
                <li class="nav-item me-4" id="heart">
                    <a href="{{route('wishlist')}}">
                        <i class="fa-solid fa-heart"></i>
                    </a>

                </li>
                @if(url()->current() != url('/cart/cart-show'))
                <li class="nav-item me-4">
                    <!-- Contenedor del icono y el badge -->

                    <span class="position-relative">
                        <!-- Icono de carrito -->
                        <i class="fa-solid fa-cart-shopping" id="shopping-card" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        </i>

                        <!-- Badge con la cantidad de elementos en el carrito -->
                        @if($contenido > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{$contenido}}
                            <span class="visually-hidden">Productos en el carrito</span>
                        </span>
                        @endif
                    </span>

                </li>
                @endif

                <li class="nav-item">
                    <div class="dropdown w-20">

                        @if (Route::has('login'))

                        @auth
                        <img src="{{ Auth::user()->profile_photo_url ?: Storage::url('user.png')}}"
                            class="rounded-circle object-cover dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" width="35" height="35"
                            alt="Imagen de perfil del usuario">

                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end position-absolute"
                            aria-labelledby="dropdownMenuLink" style="width: 10vw;">
                            <li><a href="{{ route('profile.show')}}"
                                    class="dropdown-item d-flex justify-content-between align-items-center">Mis Datos<i
                                        class="fa-regular fa-address-card"></i></i></a></li>
                            <li><a href="" class="dropdown-item d-flex justify-content-between align-items-center">Mis
                                    Pedidos<i class="fa-solid fa-box-open"></i></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                                    Sesión <i class="fa-solid fa-right-from-bracket"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>

                        @else
                        <img src="{{ Storage::url('user.png') }}" class="rounded-circle object-cover dropdown-toggle"
                            href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                            width="35" height="35" alt="Imagen de perfil">

                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end "
                            aria-labelledby="dropdownMenuLink" style="width: 10vw;">
                            <li><a href="{{ route('login') }}"
                                    class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="#">Inicie Sesión<i class="fa-solid fa-right-to-bracket"></i></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="{{ route('register')}}">Registrarse<i class="fa-solid fa-pencil"></i></a></li>
                        </ul>
                        @endauth
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Menu Para moviles --}}
<nav class="navbar navbar-expand d-flex align-items-center d-lg-none fixed-bottom rounded-pill mb-1 mx-1"
    id="nav-mobile">
    <div class="nav-item-mobile {{ Request::is('wishlist') ? 'active' : '' }}">
        <a href="{{route('wishlist')}}">
            <i class="material-icons favorite-icon">
                favorite
            </i>
        </a>
    </div>
    <div class="nav-item-mobile">
        <i class="material-icons search-icon" onclick="showSearch()">
            search
        </i>
        <div class="search-box">
            <input type="text" placeholder="Buscar..." class="search-input" name="search">
            <div class="search-background"></div>
        </div>
        <a href="#">
    </div>
    <div class="nav-item-mobile">
        <a href="{{route('inicio')}}">
            <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" id='logo' width="36" height="36">
        </a>
    </div>
    <div class="nav-item-mobile {{ Request::is('cart/cart-show') ? 'active' : '' }}">
        <a href="{{ route('cart') }}">
            <i class="material-icons shopping_cart">
                shopping_cart
            </i>
        </a>
    </div>
    <div class="nav-item-mobile">
        <span class="material-icons outlined" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobile"
            aria-controls="offcanvasRight">
            menu_open
        </span>
    </div>
</nav>

<x-offcanvas-mobile /> <!-- Offcanvas para moviles -->
@livewire('cart.cart-show-inicio')

<script>
    function showSearch() {
        var searchBox = document.querySelector('.search-box');
        searchBox.classList.toggle('show');
        searchBox.querySelector('input').focus();
    }
</script>

<style>
    /* NavBar pantalla mobiles y tablets */

    #nav-mobile {
        /* From https://css.glass */
        background: rgba(33, 33, 33, 0.9);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        border: 1px solid rgba(33, 33, 33, 0.3);
        padding: 25px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .nav-item-mobile {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        padding: 10px 15px;
        cursor: pointer;
        transition: all 0.2s ease-out;
    }

    .nav-item-mobile.active a i {
        color: #6D9886;
    }

    .material-icons {
        color: #D9D9D9;
    }

    .nav-text-mobile {
        font-size: 20px;
        margin: auto;
        text-align: center;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    #search-container {
        position: relative;
    }

    .search-box {
        position: absolute;
        bottom: 107px;
        left: 50%;
        transform: translateX(-50%);
        width: 63%;
        max-width: 400px;
        padding: 20px;
        padding-bottom: 0px;
        border-radius: 30px 30px 0 0;
        background: rgba(33, 33, 33, 0.9);
        display: none;
    }

    .search-box.show {
        display: block;
    }

    .search-input {
        width: 100%;
        border: none;
        border-bottom: 1px solid #e9e9e9;
        font-size: 16px;
        background-color: transparent;
        color: #D9D9D9
    }

    .search-background {
        position: fixed;
        width: 100%;
        height: 100%;
        display: none;
    }


    /* NavBar pantallas grandes */
    #navPrincipal {
        background-color: #212121;
    }

    .nav-link-span {
        margin-left: -3px;
    }

    #inputSearch {
        width: 40vw;
        background: transparent;
        border: 1px solid rgb(181, 189, 196);
        font-size: 16px;
        height: 40px;
        line-height: 24px;
        padding: 7px 8px;
        color: #D9D9D9;
        box-shadow: none;
    }

    #inputSearch:focus {
        background-color: transparent;
        border-color: #6D9886;
        box-shadow: 0px 2px 0 #6D9886;
    }

    #inputSearch-button {
        background-color: transparent;
        border-radius: 0 20px 20px 0;
        color: #D9D9D9;
    }

    #inputSearch-button:hover {
        background-color: #6D9886;
        box-shadow: 2px 2px 0 #D9D9D9;
        border-color: #6D9999;
    }

    #table {
        color: white
    }

    .offcanvas {
        background-color: #212121;
        color: #D9D9D9;
    }

    .offcanvas-header .btn-close {
        background-color: #D9D9D9;
    }

    #shopping-card {
        color: #D9D9D9;
    }

    #shopping-card:hover {
        color: #6D9886;
    }

    #heart {
        color: #DC143C;
        text-decoration: none;
    }

    #heart:hover {
        color: #8B0000;
        cursor: pointer;
        text-decoration: none;
    }

    .nav-item i.fa-solid.fa-heart {
        text-decoration: none;
    }

    nav .navbar-nav .nav-link {
        color: #D9D9D9;
    }

    nav .nav-link:hover {
        color: #6D9886;
    }

    #buttonCart {
        background-color: #6D9886;
    }

    #logo:hover {
        border-color: #6D9886;
        box-shadow: 1px 1px 0 #6D9886;
    }

    #buttonCart:hover {
        background-color: transparent;
        border-color: #6D9886;
        box-shadow: 3px 3px 0 #6D9886;
        color: #D9D9D9;
    }

    .fa-solid.fa-bars {
        transition: transform 0.5s ease-in-out;
    }

    .fa-regular.fa-bars-sort {
        transition: transform 0.5s ease-in-out;
        transform: rotate(90deg);
    }

    a,
    a:hover {
        color: unset;
        text-decoration: none;
    }
</style>
