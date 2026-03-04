<flux:modal name="edit-task-{{ $task->id }}" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Actualizar tarea</flux:heading>
            <flux:text class="mt-2">Actualiza la informacion de la tarea <strong>{{ $task->name }}</strong></flux:text>
        </div>

        <form wire:submit='editTask' class="space-y-5">
            <flux:input label="Nombre" wire:model='name' placeholder="Nombre de la tarea" />
            <flux:textarea label="Descripción" rows="2" wire:model='description' placeholder="Descripción de la tarea..." />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" color='sky' class="w-full">Guardar cambios</flux:button>
            </div>
        </form>
    </div>
</flux:modal>
