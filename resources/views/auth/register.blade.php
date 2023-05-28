<x-guest-layout>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="container-fluid">
            <div class="position-relative">
                <a href="{{route('inicio')}}">
                    <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras"
                        class="position-absolute top-5 start-3 d-none d-md-block img-fluid" width="100" height="100">
                </a>
            </div>
            <div class="row">
                <div class="col-md-7 p-0 d-none d-md-block">
                    <img src="{{ Storage::url('login.png') }}" class="img-fluid vh-100 vw-100">
                </div>
                <div class="col-md-5" style="background-color: #D9D9D9 ">
                    <div class="row justify-content-center align-items-center d-flex vh-100">
                        <div class="col-md-8 justify-content-center align-items">
                            <a class="d-flex flex-column justify-content-center align-items-center"
                                href="{{route('inicio')}}">
                                <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" class="position-absolute d-md-none d-sm-block img-fluid" style="margin-bottom: 180px" width="120" height="120">

                            </a>
                            <h1 class="text-center mb-4" style="font-family: Ubuntu;">Registro</h1>
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <x-label for="name" value="{{ __('Nombre de usuario') }}" />
                                    <x-input id="name" class="block mt-1 w-100" type="text" name="name"
                                        :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <div class="mb-3">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-100" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" />
                                </div>
                                <div class="mb-3">
                                    <x-label for="password" value="{{ __('Contraseña') }}" />
                                    <x-input id="password" class="block mt-1 w-100" type="password" name="password"
                                        required autocomplete="new-password" />
                                </div>
                                <div class="mb-5">
                                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-100" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-label for="terms">
                                        <div class="flex items-center">
                                            <x-checkbox name="terms" id="terms" required />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms
                                                    of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy
                                                    Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-label>
                                </div>
                                @endif
                                <button type="submit" class="btn w-100" id="btn-login">{{ __('Registrarse') }}</button>
                            </form>
                            <x-validation-errors class="mb-4 mt-4" />
                            <div class="mt-4 d-flex flex-row-reverse">
                                <a href="{{route('login')}}" class="text-gray-600">
                                    <span>Ir a iniciar sesión <i class="fa-solid fa-arrow-right mx-1"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>

<style>
    x-input {
        background-color: #D9D9D9;
    }

    #btn-login {
        background-color: #6D9886
    }

    #btn-login:hover {
        background-color: transparent;
        border-color: #6D9886;
        box-shadow: 2px 2px 0 #6D9886;
    }

    #recuerda {
        border-color: #6D9886;
    }

    #recuerda:checked {
        background-color: #6D9886;
        border-color: #6D9886;
        box-shadow: 0 0 5px #6D9886;
    }
</style>
