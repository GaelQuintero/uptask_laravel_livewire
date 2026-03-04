<flux:modal name="delete-project-{{ $projectId }}" class="min-w-88">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">¿Deseas eliminar el proyecto?</flux:heading>
            <flux:text class="mt-2">
                Por seguridad, ingresa tu contraseña para verificar que eres tu.
            </flux:text>
        </div>

        <form wire:submit='delete' class="space-y-5">
            <flux:input wire:model='password' type="password" label="Contraseña" placeholder='Ingresa tu contraseña' />
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger">Eliminar proyecto</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
