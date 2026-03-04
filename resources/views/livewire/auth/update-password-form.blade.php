<div>
    @if (!$showForm && !$passwordConfirmed)
    <form wire:submit="verifyCode" class="space-y-8 mt-4">
        <div class="max-w-64 mx-auto space-y-2">
            <flux:text class="text-center">Por favor ingresa el codigo que se te proporciono por e-mail.</flux:text>
        </div>

        <flux:otp wire:model="token" length="6" label="OTP Code" label:sr-only :error:icon="false"
            error:class="text-center" class="mx-auto" />

        <div class="space-y-4">
            <flux:button variant="primary" color="pink" type="submit" class="w-full">Verificar código</flux:button>
        </div>
    </form>
    @endif

    @if ($showForm)
    <form wire:submit="updatePassword" class="space-y-8 mt-4">
        <div class="flex justify-center" wire:transition>
            <flux:badge color="green" class="text-center">Código correcto, puede actualizar su contraseña 🎉
            </flux:badge>
        </div>

        <flux:input type="password" wire:model='password' label="Contraseña"
            placeholder='Ingresa tu nueva contraseña' />
        <flux:input type="password" wire:model='confirm_password' label="Confirmar contraseña"
            placeholder='Confirma tu contraseña' />

        <div class="space-y-4">
            <flux:button variant="primary" color="pink" type="submit" class="w-full">Actualizar contraseña
            </flux:button>
        </div>
    </form>
    @endif

    @if ($passwordConfirmed)
    <div class="mt-5" wire:transition>
        <div class="mb-5">
            <x-u-i.alert type="success" message="{{ $message }}" />
        </div>
        <flux:button href="{{ route('login') }}" variant="primary" color="pink" type="submit"
            class="w-full cursor-pointer">Iniciar sesión</flux:button>
    </div>
    @endif
</div>
