<x-action-section>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="content">
        <h2 class="text-center mb-4 display-6">Verificación en dos pasos</h2>
        <h3 class="text-center mb-1 text-danger">
            @if ($this->enabled)
            @if ($showingConfirmation)
            {{ __('Finish enabling two factor authentication.') }}
            @else
            {{ __('You have enabled two factor authentication.') }}
            @endif
            @else
            {{ __('No tienes activa la verificación en dos pasos') }}
            @endif
        </h3>

        <div class="mt-3 text-center">
            <p>
                {{ __('Cuando la autenticación de dos factores está activada, se le pedirá un token seguro y aleatorio
                durante la autenticación. Puede recuperar este token desde la aplicación Google Authenticator de su
                teléfono.') }}
            </p>
        </div>

        <div class="container mt-3">
            <h3>Modal Example</h3>
            <p>Click on the button to open the modal.</p>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
              Open modal
            </button>
          </div>

          <!-- The Modal -->
          <div class="modal" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Modal Heading</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

              </div>
            </div>
          </div>


        @if ($this->enabled)
        @if ($showingQrCode)
        <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p class="font-semibold">
                @if ($showingConfirmation)
                {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s
                authenticator application or enter the setup key and provide the generated OTP code.') }}
                @else
                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s
                authenticator application or enter the setup key.') }}
                @endif
            </p>
        </div>


        <div class="mt-4">
            {!! $this->user->twoFactorQrCodeSvg() !!}
        </div>

        <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p class="font-semibold">
                {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
            </p>
        </div>

        @if ($showingConfirmation)
        <div class="mt-4">
            <x-label for="code" value="{{ __('Code') }}" />

            <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus
                autocomplete="one-time-code" wire:model.defer="code"
                wire:keydown.enter="confirmTwoFactorAuthentication" />

            <x-input-error for="code" class="mt-2" />
        </div>
        @endif
        @endif

        @if ($showingRecoveryCodes)
        <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p class="font-semibold">
                {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to
                your account if your two factor authentication device is lost.') }}
            </p>
        </div>

        <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
            @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
            <div>{{ $code }}</div>
            @endforeach
        </div>
        @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
            <div class="d-flex justify-content-center">
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('Activar') }}
                    </x-button>
                </x-confirms-password>
            </div>
            @else
            @if ($showingRecoveryCodes)
            <x-confirms-password wire:then="regenerateRecoveryCodes">
                <x-secondary-button class="mr-3">
                    {{ __('Regenerate Recovery Codes') }}
                </x-secondary-button>
            </x-confirms-password>
            @elseif ($showingConfirmation)
            <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                <x-button type="button" class="mr-3" wire:loading.attr="disabled">
                    {{ __('Confirm') }}
                </x-button>
            </x-confirms-password>
            @else
            <x-confirms-password wire:then="showRecoveryCodes">
                <x-secondary-button class="mr-3">
                    {{ __('Show Recovery Codes') }}
                </x-secondary-button>
            </x-confirms-password>
            @endif

            @if ($showingConfirmation)
            <x-confirms-password wire:then="disableTwoFactorAuthentication">
                <x-secondary-button wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
            </x-confirms-password>
            @else
            <x-confirms-password wire:then="disableTwoFactorAuthentication">
                <x-danger-button wire:loading.attr="disabled">
                    {{ __('Disable') }}
                </x-danger-button>
            </x-confirms-password>
            @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
