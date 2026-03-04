<div class="bg-white p-6 rounded shadow md:w-7xl max-w-xl mx-auto">
    <form wire:submit='updateProfile' class="space-y-5">
        <div class="flex {{ $photo ? 'justify-between' : 'justify-center' }} gap-2 items-center">

            @if (Auth::user()->photo && Storage::disk('public')->exists(Auth::user()->photo))
            <div>
                <p class="text-center text-slate-600 mb-2 text-lg font-semibold">Mi foto actual</p>
                <img class="w-36 h-36 rounded-2xl" src="{{ Storage::url(Auth::user()->photo) }}" alt="Foto de perfil">
            </div>
            @endif

            @if ($photo)
            <div wire:transition>
                <p class="text-center text-slate-600 mb-2 text-lg font-semibold">Mi nueva foto</p>
                <img class="w-36 h-36 rounded-2xl" src="{{ $photo->temporaryUrl() }}" alt="Nueva foto de perfil">
            </div>
            @endif
        </div>
        <flux:input type="file" wire:model="photo" label="Foto de perfil"
            accept="image/jpg,image/jpeg,image/png,image/gif" />
        <flux:input type="text" label="Mi nombre" placeholder='Ingresa tu nombre' wire:model='name' />
        <flux:input type="email" label="Mi E-mail" placeholder='Ingresa tu e-mail' wire:model='email' />
        <flux:button type='submit' variant="primary" color='pink' class="w-full">Actualizar perfil</flux:button>
    </form>
</div>
