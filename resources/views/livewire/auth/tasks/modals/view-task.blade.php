<flux:modal name="view-task-{{ $task->id }}" class="md:w-auto">
    <div class="space-y-6">
        <div>
            <flux:text class="mt-2 text-xs">Creada el <strong>{{ $task->created_at->format('Y-m-d H:i:s A') }}</strong>
            </flux:text>
            <flux:text class="mt-2 text-xs">Actualizada el <strong>{{ $task->updated_at->format('Y-m-d H:i:s A')
                    }}</strong></flux:text>
            <flux:heading size="xl" class="mt-5 text-slate-500 font-bold">{{ $task->name }}</flux:heading>
        </div>

        <div>
            <p class="text-slate-600 font-bold">Historial de cambios</p>
            @forelse ($statusChanges as $status )
            <ul class=" flex justify-between list-decimal list-inside">
                <li>{{ $status->user->name ?? 'Sin nombre' }} lo ha cambiado a <strong>{{ $status->new_status }}</strong></li>
                <p>{{ $status->created_at->diffForHumans() }}</p>
            </ul>
            @empty
            <p>Sin historial de cambios</p>
            @endforelse
            <div class="mt-1">
                {{ $statusChanges->links() }}
            </div>
        </div>

        <flux:select wire:model="status" wire:change='updateStatus' label='Cambiar de estado' placeholder="Elige un estado...">
            @foreach(\App\TaskStatus::cases() as $status)
            <option value="{{ $status->value }}">
                {{ $status->label() }}
            </option>
            @endforeach
        </flux:select>
    </div>
</flux:modal>
