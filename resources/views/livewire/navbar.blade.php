<nav class="navbar navbar-expand-sm bg-body-tertiary d-none d-md-block" id="navPrincipal">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <a class="navbar-brand" href="{{route('inicio')}}">
                <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" id='logo' width="50" height="50"
                    class="me-4">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="">
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li> --}}
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
                <input class="form-control me-2 rounded-pill pl-2" id="inputSearch" type="search" placeholder="Buscar"
                    aria-label="Search">
                {{-- <button class="btn btn-outline-success" type="submit">Buscar</button> --}}
            </div>
            <ul class="navbar-nav ms-auto me-2 align-items-center">
                <li class="nav-item me-4" id="heart">
                    <a href="{{route('wishlist')}}">
                        <i class="fa-solid fa-heart" style="text-decoration: none"></i>
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
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Menu Para moviles --}}
<nav class="navbar d-md-none d-sm-block navbar-fixed-bottom" style="white">
    <div class="d-flex align-items-center">
        <a class="navbar-brand" href="{{route('inicio')}}">
            <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" id='logo' width="50" height="50"
                class="me-4">
        </a>
    </div>
    <div class="navbar-nav" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Link 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 3</a>
            </li>
        </ul>
    </div>
</nav>

@livewire('cart.cart-show-inicio')

<style>
    nav {
        background-color: #212121;
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
        box-shadow: 2px 2px 0 #6D9886;
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


    .navbar-fixed-bottom {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 1030;
    }
</style>
