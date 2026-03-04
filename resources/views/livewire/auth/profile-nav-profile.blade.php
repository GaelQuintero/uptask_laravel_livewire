<div>
    <nav class="flex gap-5">
        <button
            wire:click='viewProfileForm'
            class="p-3 font-bold transition-colors cursor-pointer {{ $currentPage == 'profile' ? 'text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">Mi
            perfil</button>
        <button
            wire:click='viewPasswordForm'
            class="p-3 text-gray-500 font-bold transition-colors cursor-pointer {{ $currentPage == 'changePassword' ? 'text-pink-500' : 'text-gray-500 hover:text-pink-500' }}">Cambiar
            contraseña</button>
    </nav>
    <hr class="w-full border-gray-300">


    <div class="mt-10 flex justify-center">
        @if ($currentPage == 'profile')
        <div wire:transition>
            <livewire:auth.profile.update-profile-form />
        </div>
        @endif

        @if ($currentPage == 'changePassword')
        <div wire:transition>
           <livewire:auth.profile.update-password-form />
        </div>
        @endif
    </div>
</div>
