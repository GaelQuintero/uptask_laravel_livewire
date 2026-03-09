<div>
    @if ($project->manager == Auth::user()->id)
    <div class="flex gap-5">
        <h1 class="text-2xl text-slate-500 font-bold mb-5">
            <button wire:click='openModalMembers'
                class="hover:underline transition-colors cursor-pointer">Colaboradores:</button>
            <span class="text-pink-500 font-bold">{{ $this->totalMembers }}</span>
        </h1>
        @if (collect($members)->isNotEmpty())
        <flux:avatar.group>
            @foreach ($members as $member )
            @if ($member->user->photo)
            <flux:avatar circle name="{{ $member->user->name }}" color="auto" color:seed="{{ $member->user->id }}"
                size="sm" src="{{ Storage::url($member->user->photo) }}" />
            @else
            <flux:avatar circle name="{{ $member->user->name }}" color="auto" color:seed="{{ $member->user->id }}"
                size="sm" />
            @endif
            @endforeach
            @if ($totalMembers > 3)
            <flux:avatar size="sm">{{ $totalMembers - 3 }}+</flux:avatar>
            @endif
        </flux:avatar.group>
        @endif
    </div>
    <div class="flex gap-2">
        <button wire:click='openModalTeam'
            class="bg-pink-500 p-3 rounded font-bold text-white uppercase hover:bg-pink-600 transition-colors cursor-pointer">Agregar
            colaborador</button>
        <button wire:click='openModalTaskCreate'
            class="bg-pink-500 p-3 rounded font-bold text-white uppercase hover:bg-pink-600 transition-colors cursor-pointer">Agregar
            tarea</button>
    </div>

    <livewire:auth.projects.modals.find-user-modal :project="$project" />
    <livewire:auth.tasks.modals.create-task :project="$project" />
    <livewire:auth.projects.modals.members-modal :project="$project" />
    @endif
</div>
