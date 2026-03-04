<div>
    <div class="flex flex-col justify-center md:justify-start">
        <h1 class="text-4xl font-black">
            Mis Proyectos:
            <span class="text-pink-500 font-bold">{{ $totalProjects }}</span>
        </h1>
        <p class="text-2xl font-normal text-gray-600 mt-5">
            Maneja y Administra tus Proyectos
        </p>
    </div>

    <div class="my-5 flex justify-center md:justify-start ">
        <button wire:click='openModal'
            class="bg-pink-500 hover:bg-pink-600 transition-colors p-3 rounded text-white uppercase font-bold cursor-pointer">Crear
            nuevo proyecto</button>
    </div>

    <livewire:auth.projects.create-modal wire:ignore />

    <div class="mt-5">
        <livewire:auth.projects.project-list />
    </div>
</div>
