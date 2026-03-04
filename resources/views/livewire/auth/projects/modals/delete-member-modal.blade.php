<div>
    @if ($member)
    <flux:modal name="deleteMember" class="w-auto">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Deseas eliminar a {{ $member->user->name }} del proyecto?</flux:heading>

                <flux:text class="mt-2">
                    Estas a punto de eliminar a un colaborador del proyecto<br>
                    Esta acción no se puede revertir.
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:button variant="ghost" wire:click='closeModal' wire:loading.attr='disabled'>Cancelar</flux:button>

                <flux:button type="submit" wire:click='deleteMember' wire:loading.attr='disabled' variant="danger">Eliminar colaborador</flux:button>
            </div>
        </div>
    </flux:modal>
    @endif
</div>
