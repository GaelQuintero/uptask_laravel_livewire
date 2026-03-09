<div>
    <div>
        @if ($project->manager == Auth::id())
        <livewire:auth.tasks.task-actions :project="$project" />
        @endif
    </div>

    <div class="flex flex-col lg:grid lg:grid-cols-5 gap-5 mt-10 overflow-x-auto lg:overflow-visible">
        {{-- Pendientes --}}
        <div class="block">
            <p class="bg-white mb-2 p-2 shadow rounded min-w-50 border-t-5 border-slate-400 font-semibold">Pendientes
            </p>
            <div class="border-2 border-dashed border-slate-300 p-1 text-center">
                <p class="font-bold text-slate-500">Soltar aqui</p>
            </div>
            <div wire:sort="changeStatusPending" wire:sort:group="tasks" class="mt-3">
                @forelse ($tasksPending as $taskPending )
                <div wire:sort:item="{{ $taskPending->id }}" class="bg-white p-4 shadow rounded min-w-50 mb-2">
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-bold text-base">
                            {{ $taskPending->name }}
                        </p>
                        <livewire:auth.tasks.options-task :task="$taskPending" :project="$project"
                            :key="'task-pending'.$taskPending->id" />
                    </div>
                    <p class="text-slate-600 font-light text-base">
                        {{ $taskPending->description }}
                    </p>
                </div>
                @empty
                <p class="text-center text-slate-500 font-bold">Sin tareas</p>
                @endforelse
            </div>
            <div class="p-3">
                {{ $tasksPending->links() }}
            </div>
        </div>

        {{-- En espera --}}
        <div class="block">
            <p class="bg-white mb-2 p-2 shadow rounded min-w-50 border-t-5 border-amber-400 font-semibold">En Espera
            </p>
            <div class="border-2 border-dashed border-slate-300 p-1 text-center">
                <p class="font-bold text-slate-500">Soltar aqui</p>
            </div>
            <div wire:sort="changeStatusOnHold" wire:sort:group="tasks" class="mt-3">
                @forelse ($tasksOnHold as $taskOnHold )
                <div wire:sort:item="{{ $taskOnHold->id }}" class="bg-white p-4 shadow rounded min-w-50 mb-2">
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-bold text-base">
                            {{ $taskOnHold->name }}
                        </p>
                        <livewire:auth.tasks.options-task :task="$taskOnHold" :project="$project"
                            :key="'task-on-hold'.$taskOnHold->id" />
                    </div>
                    <p class="text-slate-600 font-light text-base">
                        {{ $taskOnHold->description }}
                    </p>
                </div>
                @empty
                <p class="text-center text-slate-500 font-bold">Sin tareas</p>
                @endforelse
            </div>
            <div class="p-3">
                {{ $tasksOnHold->links() }}
            </div>
        </div>

        {{-- En Progreso --}}
        <div class="block">
            <p class="bg-white mb-2 p-2 shadow rounded min-w-50 border-t-5 border-indigo-400 font-semibold">En Progreso
            </p>
            <div class="border-2 border-dashed border-slate-300 p-1 text-center">
                <p class="font-bold text-slate-500">Soltar aqui</p>
            </div>
            <div wire:sort="changeStatusInProgress" wire:sort:group="tasks" class="mt-3">
                @forelse ($tasksInProgress as $taskInProgress )
                <div wire:sort:item="{{ $taskInProgress->id }}" class="bg-white p-4 shadow rounded min-w-50 mb-2">
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-bold text-base">
                            {{ $taskInProgress->name }}
                        </p>
                        <livewire:auth.tasks.options-task :task="$taskInProgress" :project="$project"
                            :key="'task-on-progress'.$taskInProgress->id" />
                    </div>
                    <p class="text-slate-600 font-light text-base">
                        {{ $taskInProgress->description }}
                    </p>
                </div>
                @empty
                <p class="text-center text-slate-500 font-bold">Sin tareas</p>
                @endforelse
            </div>
            <div class="p-3">
                {{ $tasksInProgress->links() }}
            </div>
        </div>
        {{-- En Revision --}}
        <div class="block">
            <p class="bg-white mb-2 p-2 shadow rounded min-w-50 border-t-5 border-red-400 font-semibold">En Revision
            </p>
            <div class="border-2 border-dashed border-slate-300 p-1 text-center">
                <p class="font-bold text-slate-500">Soltar aqui</p>
            </div>
            <div wire:sort="changeStatusOnReview" wire:sort:group="tasks" class="mt-3">
                @forelse ($tasksUnderReview as $taskUnderReview )
                <div wire:sort:item="{{ $taskUnderReview->id }}" class="bg-white p-4 shadow rounded min-w-50 mb-2">
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-bold text-base">
                            {{ $taskUnderReview->name }}
                        </p>
                        <livewire:auth.tasks.options-task :task="$taskUnderReview" :project="$project"
                            :key="'task-under-review'.$taskUnderReview->id" />
                    </div>
                    <p class="text-slate-600 font-light text-base">
                        {{ $taskUnderReview->description }}
                    </p>
                </div>
                @empty
                <p class="text-center text-slate-500 font-bold">Sin tareas</p>
                @endforelse
            </div>
            <div class="p-3">
                {{ $tasksInProgress->links() }}
            </div>
        </div>
        {{-- Completadas --}}
        <div class="block">
            <p class="bg-white mb-2 p-2 shadow rounded min-w-50 border-t-5 border-emerald-400 font-semibold">Completadas
            </p>
            <div class="border-2 border-dashed border-slate-300 p-1 text-center">
                <p class="font-bold text-slate-500">Soltar aqui</p>
            </div>
            <div wire:sort="changeStatusComplete" wire:sort:group="tasks" class="mt-3">
                @forelse ($tasksCompleted as $taskCompleted )
                <div wire:sort:item="{{ $taskCompleted->id }}" class="bg-white p-4 shadow rounded min-w-50 mb-2">
                    <div class="flex justify-between">
                        <p class="text-slate-500 font-bold text-base">
                            {{ $taskCompleted->name }}
                        </p>
                        <livewire:auth.tasks.options-task :task="$taskCompleted" :project="$project"
                            :key="'task-completed'.$taskCompleted->id" />
                    </div>
                    <p class="text-slate-600 font-light text-base">
                        {{ $taskCompleted->description }}
                    </p>
                </div>
                @empty
                <p class="text-center text-slate-500 font-bold">Sin tareas</p>
                @endforelse
            </div>
            <div class="p-3">
                {{ $tasksCompleted->links() }}
            </div>
        </div>
    </div>
</div>
