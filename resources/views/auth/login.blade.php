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
          <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" class="position-absolute top-5 start-3 d-none d-md-block img-fluid" width="100" height="100">
        </a>
      </div>
      <div class="row">
        <div class="col-md-7 bg-dark p-0 d-none d-md-block">
          <img src="{{ Storage::url('login.png') }}" class="img-fluid vh-100 vw-100" alt="Imagen de libro abierto">
        </div>
        <div class="col-md-5" style="background-color: #D9D9D9 ">
          <div class="row justify-content-center align-items-center d-flex vh-100">
            <div class="col-md-8 justify-content-center align-items">
              <a class="d-flex flex-column justify-content-center align-items-center" href="{{route('inicio')}}">
                <img src="{{ Storage::url('Logo.svg') }}" alt="Ir a la página principal" class="position-absolute d-md-none d-sm-block img-fluid" style="margin-bottom: 180px" width="120" height="120">
              </a>
              <h1 class="text-center mb-4">Iniciar sesión</h1>
              <form>
                @csrf
                <div class="mb-3">
                  {{-- <x-label for="email" value="{{ __('Email') }}" />
                  <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" /> --}}
                    <label for="email" class="form-label fw-bold">{{ __('Correo Electronico') }}</label>
                    <input type="email" id="email" name="email" :value="old('email')" class="form-control"autocomplete="email" required >
                </div>
                <div class="mb-3">
                  {{-- <x-label for="password" value="{{ __('Contraseña') }}" />
                  <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" /> --}}
                    <label for="password" class="form-label fw-bold">{{ __('Contraseña') }}</label>
                    <input type="password" id="password" name="password" :value="old('password')" class="form-control" autocomplete="current-password" required >
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="recuerda" name="remember">
                  <label class="form-check-label" for="recuerda">Recuérdame</label>
                </div>
                <button type="submit" class="btn w-100" id="btn-login">Iniciar Sesión</button>
              </form>
              <x-validation-errors class="mb-4 mt-4" />
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

  #recuerda {
    border-color: #6D9886;
  }

  #recuerda:checked {
    background-color: #6D9886;
    border-color: #6D9886;
    box-shadow: 0 0 5px #6D9886;
  }
</style>
