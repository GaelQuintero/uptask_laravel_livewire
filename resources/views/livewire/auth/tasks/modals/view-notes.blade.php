<flux:modal name="view-notes-{{ $task->id }}" class="md:w-auto">
    <div class="space-y-6">
        <div>
            <flux:heading size="xl" class="text-slate-500 font-bold">Notas de <strong>{{ $task->name }}</strong>
            </flux:heading>
        </div>
        @if ($showMessage)
        <div wire:transition wire:poll.5s='hiddenMessage'>
            <x-u-i.alert type='{{ $type }}' message="{{ $message }}" />
        </div>
        @endif

        <form wire:submit='createNote'>
            <flux:input.group>
                <flux:input placeholder="Escribe una nueva nota..." wire:model='content' />
                <flux:button type='submit' variant='primary' color='emerald' icon="plus-circle">Nueva nota</flux:button>
            </flux:input.group>
            <flux:error name="content" />
        </form>
    </div>

    @forelse ($notes as $note )
    <div wire:key="notes-{{ $note->id }}" class="mt-3 bg-white shadow rounded p-3 border-l-4 border-emerald-500 ">
        <div class="flex justify-between">
            <div class="flex flex-col">
                <div class="flex items-center gap-2">
                    @if ($note->creator->photo)
                    <flux:avatar circle name="{{ $note->creator->name }}" color="auto"
                        color:seed="{{ $note->creator->id }}" size="sm" src="{{ Storage::url($note->creator->photo) }}" />
                    @else
                    <flux:avatar circle name="{{ $note->creator->name }}" color="auto"
                        color:seed="{{ $note->creator->id }}" size="sm" />
                    @endif
                    <flux:heading class="text-center">{{ $note->creator->name }}</flux:heading>
                </div>
                <p class="text-xs text-slate-500" class="mt-2">Creada el {{ $note->created_at->format('Y-m-d H:i:s A')
                    }}</p>
            </div>
            @if ($note->created_by == Auth::id())
            <flux:button wire:click="deleteNote({{ $note->id }})" size='xs' icon="trash" variant='danger' />
            @endif
        </div>
        <p class="text-sm text-slate-500 mt-2">{{ $note->content }}</p>
    </div>
    @empty
    <p class="text-base text-slate-700 text-center mt-5">Esta tarea aun no cuenta con notas</p>
    @endforelse
    <div class="p-5">
        {{ $notes->links() }}
    </div>
</flux:modal>
