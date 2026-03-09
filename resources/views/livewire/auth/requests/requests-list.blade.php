<div class="flex flex-col">
    @forelse ($this->getRequets as $request)
        <div class="flex justify-between items-center bg-gray-100 rounded shadow p-5">
            <div class="flex flex-col gap-3">
                <p class="font-bold text-slate-600 text-2xl">Has sido invitado para colaborar al proyecto: <span
                        class="font-black">{{ $request->project->project_name }}</span></p>
                <p class="font-bold text-slate-600">{{ $request->manager->name }} te ha enviado la solicitud</p>
                @if ($request->project->team->count() > 0)
                    <p class="font-semibold text-slate-600">El proyecto cuenta con {{ $request->project->team->count() }}
                        colaboradores activos</p>
                @endif
                <p class="font-semibold text-slate-600 text-sm">Fecha de la invitación:
                    {{ $request->created_at->format('M d Y') }}</p>
            </div>

            <div>
                <flux:button icon='arrow-right-circle' wire:click='viewRequest({{ $request->id }})' variant='primary' color='rose' class="cursor-pointer">Ver
                    invitación</flux:button>
            </div>
        </div>
    @empty
        <p class="text-center text-slate-500 font-semibold text-2xl">No hay notificaciones</p>
    @endforelse

</div>
