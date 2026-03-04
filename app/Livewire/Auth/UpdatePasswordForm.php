<?php

namespace App\Livewire\Auth;

use App\Models\Token;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    public $token;
    public $password;
    public $confirm_password;

    public $showForm = false;
    public $passwordConfirmed = false;
    public $message = '';

    public function verifyCode()
    {
        $data = $this->validate([
            'token' => 'required|max:6'
        ], [
            'token.required' => 'El código es obligatorio',
            'token.max' => 'El código solo puede contener 6 digitos',
        ]);

        //Verificar si existe un token
        $token = Token::query()->where('token', $data['token'])->where('type', Token::RESET_PASSWORD)->first();

        if (!$token) {
            return $this->addError('token', 'Código no válido');
        }

        $this->token = $token->token;

        $this->showForm = true;
    }

    public function updatePassword()
    {
        $data = $this->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'same:password'
        ], [
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe de tener al menos 8 caracteres',

            'confirm_password.same' => 'La contraseña no coincide'
        ]);

        //Buscar al usuario relacionado al token
        $token = Token::query()->where('token', $this->token)
            ->where('type', Token::RESET_PASSWORD)
            ->first();


        if (!$token) {
            return $this->addError('password', 'El codigó ya noes válido o expiró');
        }

        $user = User::find($token->user_id);

        if (!$user) {
            return $this->addError('password', 'Usuario no encontrado');
        }

        $user->update([
            'password' => $data['password']
        ]);

        $token->delete();

        $this->reset(['password', 'confirm_password']);

        $this->showForm = false;

        $this->passwordConfirmed = true;


        $this->message = 'Contraseña actualizada correctamente 🎉';
    }

    public function render()
    {
        return view('livewire.auth.update-password-form');
    }
}
