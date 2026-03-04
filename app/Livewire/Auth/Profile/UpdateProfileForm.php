<?php

namespace App\Livewire\Auth\Profile;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class UpdateProfileForm extends Component
{
    use WithSweetAlert, WithFileUploads;
    public User $user;
    public $photo;
    public $name;
    public $email;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $data = $this->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ]
        ], [
            'name.required' => 'El nombre es obligatorio',

            'email.required' => 'El e-mail es obligatorio',
            'email.unique' => 'El e-mail ingresado ya esta en uso',

            'photo.image' => 'El archivo debe ser una imagen',
            'photo.max' => 'La imagen no debe pesar más de 2MB',
        ]);

        //Verificar si la propiedad cumple con esa instancia e insertar la imagen
        if ($this->photo instanceof TemporaryUploadedFile) {
            //Si la propiedad del usuario y en el storage existe la imagen, se elimina
            if ($this->user->photo && Storage::exists($this->user->photo)) {
                Storage::delete($this->user->photo);
            }

            $photoPath = $this->photo->store('photos', 'public');
        }



        //Actualizar el perfil del usuario
        $this->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'photo' => $photoPath ?? Auth::user()->photo
        ]);

        $this->reset(['photo']);

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Perfil actualizado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }



    public function render()
    {
        return view('livewire.auth.profile.update-profile-form');
    }
}
