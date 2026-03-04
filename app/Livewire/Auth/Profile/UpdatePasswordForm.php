<?php

namespace App\Livewire\Auth\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class UpdatePasswordForm extends Component
{
    use WithSweetAlert;
    public User $user;
    public $current_password;
    public $password;
    public $confirm_password;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatePassword()
    {
        $credentials = $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ], [
            'current_password.required' => 'Tu contraseña actual es obligatoria',

            'password.required' => 'La nueva contraseña es obligatoria',
            'password.min' => 'La nueva contraseña debe de tener al menos 8 caracteres',

            'confirm_password.required' => 'Repetir tu contraseña es obligatorio',
            'confirm_password.same' => 'La nueva contraseña no coincide'
        ]);

        //Verificar si la contraseña es correcta
        if (!Hash::check($credentials['current_password'], $this->user->password)) {
            return $this->addError('current_password', 'La contraseña es incorrecta');
        }

        //Actualizar contraseña
        $this->user->update([
            'password' => Hash::make($credentials['password'])
        ]);

        //Resetear los inputs
        $this->reset(['current_password', 'password', 'confirm_password']);

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Contraseña actualizada correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }
    public function render()
    {
        return view('livewire.auth.profile.update-password-form');
    }
}
