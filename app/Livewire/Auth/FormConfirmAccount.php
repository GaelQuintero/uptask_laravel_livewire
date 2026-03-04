<?php

namespace App\Livewire\Auth;

use App\Models\Token;
use App\Models\User;
use Flux\Flux;
use Livewire\Component;

class FormConfirmAccount extends Component
{
    public $token;
    public $message;

    public $showForm = true;

    public function verify()
    {
        //Validar el token
        $token = $this->validate([
            'token' => 'required|max:6|exists:tokens,token'
        ], [
            'token.required' => 'El código es obligatorio',
            'token.max' => 'El código solo puede contener 6 digitos',
            'token.exists' => 'Código no válido'
        ]);

        //Buscar el id del usuario por el token
        $userId = Token::query()->where('token', $token['token'])->where('type', Token::CONFIRM_ACCOUNT)->value('user_id');

        //Obtener el status del usuario
        $user = User::query()->where('id', $userId)->first();

        //Confirmar cuenta
        $user->confirmed = true;
        $user->save();

        //Eliminar token de la base de datos
        Token::query()->where('token', $token)->delete();


        //Ocultar formulario
        $this->showForm = false;

        //Mostrar mensaje;
        $this->message = 'Se confirmo tu cuenta correctamente';
    }

    public function openResendCodeModal()
    {
        Flux::modal('resend-code')->show();
    }


    public function render()
    {
        return view('livewire.auth.form-confirm-account');
    }
}
