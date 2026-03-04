<flux:modal name="edit-project-{{ $projectId }}" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Proyecto: {{ $project->project_name }}</flux:heading>
            <flux:text class="mt-2">Actualizar información del proyecto.</flux:text>
        </div>

        <form wire:submit='editProject' class="space-y-5">
            <flux:input label="Nombre del proyecto" placeholder="Ingresa el nombre del proyecto"
                wire:model='project_name' />

            <flux:input label="Nombre del cliente" type="text" placeholder="Ingresa el nombre del cliente"
                wire:model='client_name' />

            <flux:textarea rows='2' label="Descripción del proyecto" placeholder="Descripción..."
                wire:model='description' />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" color='pink' class="w-full">Guardar cambios</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
