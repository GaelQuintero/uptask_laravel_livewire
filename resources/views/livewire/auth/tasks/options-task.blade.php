<div>
    <flux:dropdown position="bottom" align="end">
        <flux:button size='sm' icon:trailing="ellipsis-vertical"></flux:button>

        <flux:menu>
            <flux:menu.item wire:click="viewTask" icon="eye">Ver tarea</flux:menu.item>
            <flux:menu.separator />

            @if ($project->manager == Auth::id())
            <flux:menu.item wire:click="openEditModal" icon="pencil">Editar tarea</flux:menu.item>
            <flux:menu.separator />
            @endif

            <flux:menu.item wire:click="viewNotes" icon="clipboard-document-list">Ver notas</flux:menu.item>

            @if ($project->manager == Auth::id())
            <flux:menu.separator />

            <flux:menu.item wire:click="openDeleteModal" variant="danger" icon="trash">Eliminar</flux:menu.item>
            @endif
        </flux:menu>
    </flux:dropdown>
    <livewire:auth.tasks.modals.view-task :task="$task" />
    <livewire:auth.tasks.modals.edit-task :task="$task" />
    <livewire:auth.tasks.modals.view-notes :task="$task" />
    <livewire:auth.tasks.modals.delete-task :task="$task" />
</div>
