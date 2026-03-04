<?php

namespace App\Livewire\Auth;

use App\Models\Token;
use App\Models\User;
use App\Notifications\ForgotPasswordCode;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ForgotPasswordForm extends Component
{
    use WithSweetAlert;
    public $email;

    public function sendForgotPasswordCode()
    {

        //Validar formulario
        $data = $this->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'El e-mail es obligarorio',
            'email.email' => 'E-mail no válido'
        ]);

        //Verificar si el usuario existe
        $user = User::query()->where('email', $data['email'])->first();

        if (!$user) {
            return $this->addError('email', 'La cuenta no existe');
        }

        //Transaccion para eliminar y crear token
        $result =  DB::transaction(function () use ($user) {

            Token::query()->where('user_id', $user->id)->where('type', Token::RESET_PASSWORD)->delete();

            //Generar nuevo token
            $newToken = Token::create([
                'token' => random_int(100000, 999999),
                'type' => Token::RESET_PASSWORD,
                'user_id' => $user->id,
                'expires_at' => now()->addMinutes(10)
            ]);

            return $newToken;
        });

       //Enviar correo para recuperar contraseña
       $user->notify(new ForgotPasswordCode($user->name, $result->token));

       //Reiniciar formulario
       $this->reset(['email']);

       //Enviar mensaje exitoso al usuario
       $this->swalSuccess([
            'title' => 'Código enviado correctamente',
            'text' => 'Revisa tu e-mail.',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-form');
    }
}
