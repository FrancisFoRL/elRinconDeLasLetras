<!-- Offcanvas Shopping Card -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMobile" aria-labelledby="offcanvasMobileLabel">
    <div class="offcanvas-header">
        <p id="offcanvasMobileLabel" class="visually-hidden">Menú móvil</p>
        @if (Route::has('login'))

        @auth
        <img src="{{ Auth::user()->profile_photo_url ?: Storage::url('user.png')}}" class="rounded-circle object-cover"
            width="35" height="35" alt="Imagen de perfil del usuario">
        <p class="my-auto fw-bold"> Hola, {{Auth::user()->name}} </p>

        @else
        <img src="{{ Storage::url('user.png') }}" class="rounded-circle object-cover dropdown-toggle" href="#"
            role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" width="35" height="35"
            alt="Imagen de perfil">

        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end " aria-labelledby="dropdownMenuLink"
            style="width: 10vw;">
            <li><a href="{{ route('login') }}" class="dropdown-item d-flex justify-content-between align-items-center"
                    href="#">Inicie Sesión<i class="fa-solid fa-right-to-bracket"></i></a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item d-flex justify-content-between align-items-center"
                    href="{{ route('register')}}">Registrarse<i class="fa-solid fa-pencil"></i></a></li>
        </ul>
        @endauth
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex align-items-center justify-content-end pe-4">
        <ul class="fs-1 list-unstyled">
            @if(Auth::user())
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('profile.show')}}">Mis Datos</a>
            </li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('pedidos')}}">Mis Pedidos</a>
            </li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('opiniones')}}">Mis Reseñas</a>
            </li>
            @else
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('login')}}">Iniciar Sesión</a>
            </li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('register')}}">Registrarse</a>
            </li>
            @endif
            <li class="mb-4 text-end"><span type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCategory"
                    aria-controls="offcanvasRight">
                    Categorias
                </span></li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('contacto.show')}}">Contacto</a>
            </li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('info-legal')}}">Información
                    Legal</a>
            </li>
            <li class="mb-4 text-end"><a class="text-decoration-none" href="{{ route('privacidad')}}">Política de
                    Privacidad</a>
            </li>
            @if(Auth::user())
            <li class="mb-4 text-end">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                    Sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endif
        </ul>
    </div>
</div>

<!-- Offcanvas Categorias -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
    <div class="offcanvas-header p-4">
        <p class="offcanvas-title fs-1" id="offcanvasCategoryLabel" class="visually-hidden">Categorias</p>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex align-items-center justify-content-end pe-4">
        <ul class="fs-3 list-unstyled py-3">
            @foreach ($categorias as $categoria)
            <li class="mb-2 text-end"><a href="{{ route('category.show', $categoria->slug) }}"
                    class="text-decoration-none">{{
                    $categoria->name }}</a>
                @endforeach
        </ul>
    </div>

</div>

<style>
    .offcanvas ul li a {
        color: #D9D9D9;
    }
</style>
