<div>
    <flux:dropdown position="bottom" align="end">
        <flux:button icon:trailing="ellipsis-vertical"></flux:button>

        <flux:menu>
            <flux:menu.item wire:click="viewProject" icon="eye">Ver proyecto</flux:menu.item>
            @if ($project->manager == Auth::id())
            <flux:menu.separator />

            <flux:menu.item wire:click="openEditModal" icon="pencil">Editar proyecto</flux:menu.item>
            <flux:menu.separator />

            <flux:menu.item wire:click="openDeleteModal" variant="danger" icon="trash">Eliminar</flux:menu.item>
            @endif
        </flux:menu>
    </flux:dropdown>

    <livewire:auth.projects.modals.delete-project :projectId="$projectId" />
    <livewire:auth.projects.modals.edit-project :projectId="$projectId" />
</div>
