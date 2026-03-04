<flux:modal name="resend-code" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Reenviar código de confirmación</flux:heading>
            <flux:text class="mt-2">Escribe tu e-mail para recibir un nuevo código</flux:text>
        </div>
        <form wire:submit='resendCode'>
            <flux:input label="E-mail" wire:model='email' placeholder="Ingresa tu e-mail" />
            <div class="flex mt-5">
                <flux:spacer />
                <flux:button type="submit" color='pink' variant="primary">Enviar código</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
