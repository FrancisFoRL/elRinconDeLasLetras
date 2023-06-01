<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="w-100 text-center">
            <div class="p-4" id="cont-img">
                <!-- Profile Photo File Input -->
                <input type="file" class="visually-hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" class="visually-hidden" value="{{ __('Imagen') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-circle object-cover img-perfil" style="border: 5px solid #6D9886" width="350" height="350">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="d-block rounded-circle w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <div class="mt-2" x-if="photoPreview == null">
                    <img :src="photoPreview" alt="Foto de Perfil" class="rounded-circle object-cover"
                        style="color:transparent" width="350" height="350">
                </div>


                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Cambiar la imagen de Perfil') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                    {{ __('Eliminar Imagen de Perfil') }}
                </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        </div>
        @endif


        <h2 class="text-center mt-4 display-6">Datos de Usuario</h2>
        <!-- Name -->
        <div>

        </div>
        <div class="row justify-content-center">

            <div class="col-11 col-md-3">
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" type="text" class="mt-1 block w-100" wire:model.defer="state.name"
                    autocomplete="name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-11 col-md-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-100" wire:model.defer="state.email"
                    autocomplete="username" />
                <x-input-error for="email" class="mt-2" />

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !
                $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
                @endif
            </div>
        </div>

    </x-slot>

    <x-slot name="actions">
        <div class="d-flex justify-content-center">
            <x-action-message class="mt-lg-3" on="saved">
                {{ __('Datos Actualizados') }}
            </x-action-message>
        </div>

        <div class="d-flex justify-content-center mt-2">
            <x-button wire:loading.attr="disabled" class="mt-lg-3" wire:target="photo">
                {{ __('Guardar') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>


<style>
    #cont-img {
        background-color: #212121;
        border-radius: 12px 12px 0 0;
    }

    @media(max-width:495px){
        .img-perfil{
            width: 100%;
            height: 10%;
        }
    }
</style>
