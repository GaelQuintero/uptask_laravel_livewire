<div class="bg-slate-800 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4 md:p-6">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="text-slate-100 font-black text-4xl md:text-6xl">
            <span class="text-pink-500">Up</span>Task
        </a>

        <!-- Menu Desktop -->
            <flux:dropdown position="bottom" align="end">
                <flux:button icon:trailing="bars-3"></flux:button>

                <flux:menu>
                    <flux:text class="text-center text-base" variant="strong">Hola {{ Auth::user()->name }}</flux:text>
                    <flux:menu.separator />
                    <flux:menu.item wire:click='profile' icon="user">Mi perfil</flux:menu.item>
                    <flux:menu.separator />

                    <flux:menu.item wire:click='logout' variant="danger" icon="arrow-right-start-on-rectangle">Cerrar sesión</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
    </div>
</div>
