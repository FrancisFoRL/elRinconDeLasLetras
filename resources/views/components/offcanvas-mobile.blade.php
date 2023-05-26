<!-- Offcanvas Shopping Card -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMobile" aria-labelledby="offcanvasMobileLabel">
    <div class="offcanvas-header">
        <p id="offcanvasMobileLabel" class="visually-hidden">Menú móvil</p>
        @if (Route::has('login'))

                        @auth
                        <img src="{{ Auth::user()->profile_photo_url ?: Storage::url('user.png')}}"
                            class="rounded-circle object-cover dropdown-toggle" href="#" role="button"
                            id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" width="35" height="35"
                            alt="Imagen de perfil del usuario">
                        <p class="my-auto fw-bold"> Hola, {{Auth::user()->name}} </p>
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
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

    </div>
</div>
