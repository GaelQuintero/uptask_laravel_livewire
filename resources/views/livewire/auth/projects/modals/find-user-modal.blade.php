<flux:modal name="find-user" class="md:w-auto">
    <div class="space-y-6">
        <div>
            <flux:heading size="xl">Agregar colaborador</flux:heading>
            <flux:text class="mt-2">Ingresa un e-mail valido y agrega al usuario a tu proyecto.</flux:text>
        </div>

        <form wire:submit='findUser' class="space-y-5">
            <flux:field>
                <flux:label>E-mail</flux:label>
                @if ($message)
                <div wire:transition class="mb-2">
                    <x-u-i.alert message="{{ $message }}" type='error' />
                </div>
                @endif
                <flux:input wire:model='email' placeholder="Ingresa el e-mail del usuario" />
                <flux:error name="email" />
            </flux:field>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" color='pink' class="w-full">Buscar usuario</flux:button>
            </div>
        </form>
    </div>

    @if ($result)
    <div wire:transition>
        <p class="text-center text-base mt-5 text-slate-500 font-bold">Resultados:</p>
        <div class="flex justify-between mt-3 items-center">
            <div class="flex gap-3 items-center">
                @if ($result->photo && Storage::disk('public')->exists($result->photo))
                <flux:avatar circle name="{{ $result->name }}" color="auto" color:seed="{{ $result->id}}" size="sm"
                    src="{{ Storage::url($result->photo) }}" />
                @else
                <flux:avatar circle name="{{ $result->name }}" color="auto" color:seed="{{ $result->id}}" size="sm" />
                @endif
                <flux:heading class="text-sm font-semibold">{{$result->name }}
                    @if($result->id == Auth::id())
                    <flux:badge size="sm" color="blue" class="ml-1 max-sm:hidden">Eres tu</flux:badge>
                    @endif
                </flux:heading>
            </div>
            <flux:button wire:click='addMember' size="xs" variant='primary' color='sky'>Añadir al proyecto</flux:button>
        </div>
    </div>
    @endif

</flux:modal>
