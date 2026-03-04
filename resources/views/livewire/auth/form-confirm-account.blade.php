<div class="mt-2">
    @if ($showForm)
    <form wire:submit="verify" class="space-y-8">
        <div class="max-w-64 mx-auto space-y-2">
            <flux:text class="text-center">Por favor ingresa el codigo que se te proporciono por e-mail.</flux:text>
        </div>

        <flux:otp wire:model="token" length="6" label="OTP Code" label:sr-only :error:icon="false"
            error:class="text-center" class="mx-auto" />

        <div class="space-y-4">
            <flux:button variant="primary" color="pink" type="submit" class="w-full">Verificar cuenta</flux:button>
            <flux:button wire:click="openResendCodeModal" class="w-full">Reenviar código</flux:button>
        </div>
    </form>
    <livewire:auth.resend-token-modal />
    @endif

    @if (!$showForm)
        <div class="mt-5" wire:transition>
            <div class="mb-5">
                <x-u-i.alert type="success" message="{{ $message }}" />
            </div>
            <flux:button  href="{{ route('login') }}" variant="primary" color="pink" type="submit" class="w-full cursor-pointer">Iniciar sesión</flux:button>
        </div>
    @endif

</div>
