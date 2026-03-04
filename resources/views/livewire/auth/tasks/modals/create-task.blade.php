<flux:modal name="create-task" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Crear tarea</flux:heading>
            <flux:text class="mt-2">Crea una tarea para tu proyecto.</flux:text>
        </div>

        <form wire:submit='createTask' class="space-y-5">
            <flux:input label="Nombre" wire:model='name' placeholder="Nombre de la tarea" />
            <flux:textarea label="Descripción" rows="2" wire:model='description' placeholder="Descripción de la tarea..." />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" color='pink' class="w-full">Crear tarea</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
