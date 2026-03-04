<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Token;
use App\Models\User;
use App\Notifications\ConfirmAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function registerView(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        try {
            //Crear al usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            //Generar token
            $token = Token::create([
                'token' => random_int(100000, 999999),
                'type' => Token::CONFIRM_ACCOUNT,
                'user_id' => $user->id,
                'expires_at' => now()->addMinutes(10)
            ]);

            //Enviar e-mail
            $user->notify(new ConfirmAccount($user->name, $token->token));

            return back()->with(['message' => 'Tu cuenta se creó correctamente, revisa tu e-mail para confirmar tu cuenta 🎉', 'status' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['message' => 'Hubo un error', 'status' => 'error']);
        }
    }

    public function auth(LoginRequest $request): RedirectResponse
    {
        try {

            $user = User::query()->where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
            }

            if (!$user->confirmed) {
                return back()->withErrors(['email' => 'Tu cuenta no ha sido confirmada'])->withInput();
            }

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return back()
                    ->withErrors(['password' => 'Contraseña incorrecta'])
                    ->withInput();
            }

            $request->session()->regenerate();

            return redirect('/dashboard')->with(['message' => "Hola {$user->name}", 'status' => 'success']);

        } catch (\Throwable $th) {
            return back()->with(['message' => 'Hubo un error', 'status' => 'error']);
        }
    }

    public function confirmAccountView(): View
    {
        return view('auth.confirm-account');
    }

    public function forgotPasswordView(): View
    {
        return view('auth.forgot-password');
    }

    public function updatePasswordView(): View
    {
        return view('auth.update-password');
    }
}
