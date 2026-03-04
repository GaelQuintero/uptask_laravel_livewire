<form method="POST" class="space-y-5 mt-5" action="{{ route('auth') }}">
    @csrf
    <div class="flex flex-col space-y-1">
        <label class="text-gray-600 font-black" for="email">E-mail</label>
        <input class="p-2 border border-slate-200" type="email" name="email" id="email" placeholder="Ingresa tu e-mail" autocomplete="on">
        @error('email')
            <x-u-i.alert type="error" message="{{ $message }}" />
        @enderror
    </div>

    <div class="flex flex-col space-y-1">
        <label class="text-gray-600 font-black" for="password">Contraseña</label>
        <input class="p-2 border border-slate-200" type="password" name="password" id="password" placeholder="Ingresa tu contraseña">
        @error('password')
            <x-u-i.alert type="error" message="{{ $message }}" />
        @enderror
    </div>

    <input type="submit" value="Iniciar sesión" class="bg-pink-500 hover:bg-pink-600 w-full p-2 uppercase text-white font-bold rounded cursor-pointer">
</form>
