<flux:modal name="delete-task-{{ $task->id }}" class="min-w-88">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">¿Eliminar la tarea?</flux:heading>

            <flux:text class="mt-2">
                Estas a punto de borrar la tarea <strong>{{ $task->name }}</strong><br>
                Esta acción no se puede revertir.
            </flux:text>
            @if ($message)
                 <div class="mt-2">
                    <x-u-i.alert message="{{ $message }}" type='error' />
                </div>
            @endif
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">Cancelar</flux:button>
            </flux:modal.close>

            <flux:button wire:click='deleteTask' type="submit" wire:loading.attr='disabled' variant="danger">Eliminar tarea</flux:button>
        </div>
    </div>
</flux:modal>
