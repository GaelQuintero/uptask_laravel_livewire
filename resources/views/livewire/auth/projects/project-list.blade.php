<div class="flex flex-col">
    @forelse ($projects as $project )
    <div class="bg-white shadow my-2 p-5 border-t-5 {{ $project->manager == Auth::id() ? 'border-pink-500' : 'border-emerald-500' }}" wire:key='{{ $project->id }}'>
         <flux:badge size='sm' color="{{ $project->manager == Auth::id() ? 'pink' : 'emerald'  }}">{{ $project->manager == Auth::id() ? 'Manager' : 'Colaborador'  }}</flux:badge>
        <div class=" flex justify-between">
            <a href="{{ route('view-project', $project->id) }}" class="text-2xl text-slate-500 font-bold hover:underline">{{ $project->project_name }}</a>
            <livewire:auth.projects.dropdown-project :projectId="$project->id" />
        </div>
        <p class="text-lg text-slate-500 font-normal">{{ $project->client_name }}</p>
        <p class="text-lg text-slate-400 font-normal">{{ $project->description }}</p>
    </div>
    @empty
    <p class="text-center text-2xl text-slate-500">No hay proyectos creados</p>
    @endforelse

    @if (collect($projects)->isNotEmpty())
    <div class="p-3">
        {{ $projects->links(data: ['scrollTo' => false]) }}
    </div>
    @endif
</div>
