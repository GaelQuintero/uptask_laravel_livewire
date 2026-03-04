<flux:modal name="createProject" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Crea un nuevo proyecto</flux:heading>
            <flux:text class="mt-2">Ingresa la información de tu nuevo proyecto.</flux:text>
        </div>

        <form wire:submit='createProject' class="space-y-5">
            <flux:input label="Nombre del proyecto" placeholder="Ingresa el nombre del proyecto"
                wire:model='project_name' />

            <flux:input label="Nombre del cliente" type="text" placeholder="Ingresa el nombre del cliente"
                wire:model='client_name' />

            <flux:textarea rows='2' label="Descripción del proyecto" placeholder="Descripción..."
                wire:model='description' />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" color='pink' class="w-full">Crear proyecto</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
