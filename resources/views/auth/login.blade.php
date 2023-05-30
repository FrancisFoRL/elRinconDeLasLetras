<x-guest-layout>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container-fluid">
            <div class="position-relative text-center">
                <a href="{{route('inicio')}}">
                    <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras"
                        class="position-absolute top-5 start-3 mt-3 d-none d-md-block img-fluid" width="100"
                        height="100">
                </a>
            </div>
            <div class="row">
                <div class="col-md-7 bg-dark p-0 d-none d-md-block">
                    <img src="{{ Storage::url('login.png') }}" class="img-fluid vh-100 vw-100"
                        alt="Imagen de libro abierto">
                </div>
                <div class="col-md-5" style="background-color: #D9D9D9 ">
                    <div class="row justify-content-center align-items-center d-flex vh-100">
                        <div class="col-md-8 justify-content-center align-items">
                            <a class="d-flex flex-column justify-content-center align-items-center"
                                href="{{route('inicio')}}">
                                <img src="{{ Storage::url('Logo.svg') }}"
                                    alt="Logo El Rincon de las Letras - Ir a la página principal"
                                    class="position-absolute d-md-none d-sm-block img-fluid"
                                    style="margin-bottom: 180px" width="120" height="120">
                            </a>

                            <h1 class="text-center mb-4 display-6" style="font-family: Ubuntu;">Iniciar sesión</h1>
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-100" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username"
                                        :value="old('email')" />
                                    {{-- <label for="email" class="form-label fw-bold">{{ __('Correo Electronico')
                                        }}</label>
                                    <input type="email" id="email" name="email" :value="old('email')"
                                        class="form-control" autocomplete="email" required> --}}
                                </div>
                                <div class="mb-3">
                                    <x-label for="password" value="{{ __('Contraseña') }}" />
                                    <x-input id="password" class="d-block mt-1 w-100" type="password" name="password"
                                        required autocomplete="current-password" :value="old('password')" />
                                    {{-- <label for="password" class="form-label fw-bold">{{ __('Contraseña') }}</label>
                                    <input type="password" id="password" name="password" :value="old('password')"
                                        class="form-control" autocomplete="current-password" required>
                                </div> --}}
                                <div class="mt-3 form-check d-flex justify-content-between">
                                    <div>
                                        {{-- <input type="checkbox" class="form-check-input" id="recuerda"
                                            name="remember">
                                        <label class="form-check-label" for="recuerda">Recuérdame</label> --}}
                                        <label for="remember_me" class="flex items-center">
                                            <x-checkbox id="remember_me" name="remember" />
                                            <span class="ml-2 text-sm fw-bold">{{ __('Recuerdame') }}</span>
                                        </label>
                                    </div>
                                    {{-- <div class="d-flex flex-row-reverse">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600"
                                            href="{{ route('password.request') }}">
                                            {{ __('¿Olvidaste tu contraseña?') }}
                                        </a>
                                        @endif
                                    </div> --}}
                                </div>
                                <button type="submit" class="btn w-100 mt-3" id="btn-login">Iniciar Sesión</button>
                            </form>
                            <div class="mt-4 d-flex flex-row-reverse">
                                <a href="{{route('register')}}" style="color:#24547D">
                                    <span>Ir a registro <i class="fa-solid fa-arrow-right mx-1"></i></span>
                                </a>
                            </div>
                            <x-validation-errors class="mb-4 mt-4 text-center text-md-start p-3" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

<style>
    #btn-login {
        background-color: #6D9886;
    }

    #btn-login:hover {
        background-color: transparent;
        border-color: #6D9886;
        box-shadow: 2px 2px 0 #6D9886;
    }
</style>
