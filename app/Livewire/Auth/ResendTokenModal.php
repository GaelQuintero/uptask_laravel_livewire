<?php

namespace App\Livewire\Auth;

use App\Models\Token;
use App\Models\User;
use App\Notifications\ConfirmAccount;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ResendTokenModal extends Component
{
    use WithSweetAlert;
    public $email;


    public function resendCode()
    {
        $data = $this->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'El e-mail es obligatorio',
            'email.email' => 'E-mail no válido'
        ]);

        //Buscar al usuario y enviarle un nuevo correo
        $user = User::query()->where('email', $data['email'])->first();

        //Verificar si el usuario existe
        if (!$user) {
            $this->addError('email', 'El e-mail no existe');
            return;
        }

        //Verificar si el usuario ya esta confirmado
        if ($user && $user->confirmed) {
            return $this->addError('email', 'Esta cuenta ya esta confirmada');
        }


        //Transaccion para eliminar y crear token
        $result =  DB::transaction(function () use ($user) {

            Token::query()->where('user_id', $user->id)->where('type', Token::CONFIRM_ACCOUNT)->delete();

            //Generar nuevo token
            $newToken = Token::create([
                'token' => random_int(100000, 999999),
                'type' => Token::CONFIRM_ACCOUNT,
                'user_id' => $user->id,
                'expires_at' => now()->addMinutes(10)
            ]);

            return $newToken;
        });

        //Enviar e-mail
        $user->notify(new ConfirmAccount($user->name, $result->token));

        //Limpiar formulario
        $this->reset(['email']);

        //Cerrar modal y mostrar mensaje
        Flux::modal('resend-code')->close();
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
        return view('livewire.auth.resend-token-modal');
    }
}
