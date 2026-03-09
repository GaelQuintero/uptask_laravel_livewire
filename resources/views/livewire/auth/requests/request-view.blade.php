<div class="flex flex-col justify-center items-center bg-gray-100 shadow rounded p-5 space-y-8">
    @if ($showMessage)
    <div wire:transition>
        <x-u-i.alert type="error" message="{{ $message }}" />
    </div>
    @endif
    <p class="text-3xl font-semibold text-slate-500">{{ $this->request->project->project_name }}</p>

    <div class="flex gap-5">
        @if ($request->manager->photo && Storage::disk('public')->exists($request->manager->photo))
            <flux:avatar circle name="{{ $request->manager->name }}" color="auto"
                color:seed="{{ $request->manager->id }}" size='lg'
                src="{{ Storage::url($request->manager->photo) }}" />
        @else
            <flux:avatar circle name="{{ $request->manager->name }}" color="auto"
                color:seed="{{ $request->manager->id }}" size='lg' />
        @endif
        <p class="text-lg mt-2">+</p>
        @if (Auth::user()->photo && Storage::disk('public')->exists(Auth::user()->photo))
            <flux:avatar circle name="{{ Auth::user()->name }}" color="auto" color:seed="{{ Auth::id() }}"
                size='lg' src="{{ Storage::url(Auth::user()->photo) }}" />
        @else
            <flux:avatar circle name="{{ Auth::user()->name }}" color="auto" color:seed="{{ Auth::id() }}"
                size='lg' />
        @endif
    </div>
    <p class="font-semibold text-slate-500">{{ $request->manager->name }} te esta invitando a colaborar en su proyecto
    </p>

    <div class="flex gap-3">
        <flux:button variant='primary' color='red' wire:click='decline'>Rechazar</flux:button>
        <flux:button variant='primary' color='green' wire:click='accept'>Aceptar</flux:button>
    </div>
    <flux:button href="/requests" wire:navigate variant="subtle">Volver</flux:button>
</div>
