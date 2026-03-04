<div class="bg-white p-6 rounded shadow md:w-7xl max-w-xl mx-auto">
    <form wire:submit='updatePassword' class="space-y-5">
        <flux:heading size="xl" class="text-center">Actualiza tu contraseña</flux:heading>
        <flux:input type="password" label="Mi contraseña actual" placeholder='Ingresa tu contraseña actual' wire:model='current_password' />
        <flux:input type="password" label="Mi nueva contraseña" placeholder='Ingresa tu nueva contraseña' wire:model='password' />
        <flux:input type="password" label="Verificar contraseña" placeholder='Ingresa de nuevo tu nueva contraseña' wire:model='confirm_password' />
        <flux:button type='submit' variant="primary" color='pink' class="w-full">Actualizar constraseña</flux:button>
    </form>
</div>
