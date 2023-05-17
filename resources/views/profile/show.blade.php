<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 d-none d-lg-block">
                <x-nav-perfil />
            </div>
            <div class="col-12 col-lg-10">
                <div class="mx-auto m-4" id="contendor-princ">
                    <div>
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')


                        @endif
                    </div>


                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-5 mb-5">
                        @livewire('profile.update-password-form')
                    </div>

                    <x-section-border />
                    @endif

                    {{-- @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-5">
                        @livewire('profile.two-factor-authentication-form')
                    </div>

                    <x-section-border />
                    @endif --}}

                    {{-- <div class="mt-5 ">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div> --}}

                    {{-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-section-border />

                    <div class="mt-5 ">
                        @livewire('profile.delete-user-form')
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    #contendor-princ {
        border: 2px solid #222222;
        border-radius: 15px;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }
</style>
