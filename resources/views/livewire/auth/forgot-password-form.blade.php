<form wire:submit='sendForgotPasswordCode' class="space-y-5 mt-5">
    <div class="flex flex-col space-y-1">
        <label class="text-gray-600 font-black" for="email">E-mail</label>
        <input class="p-2 border border-slate-200" type="email" wire:model="email" placeholder="Ingresa tu e-mail">
        @error('email')
        <x-u-i.alert type="error" message="{{ $message }}" />
        @enderror
    </div>
    <input type="submit" value="Enviar"
        class="bg-pink-500 hover:bg-pink-600 w-full p-2 uppercase text-white font-bold rounded cursor-pointer">
</form>
