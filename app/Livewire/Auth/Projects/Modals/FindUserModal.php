<?php

namespace App\Livewire\Auth\Projects\Modals;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class FindUserModal extends Component
{
    use WithSweetAlert;
    public $email;
    public User $result;
    public Project $project;

    public $message;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function findUser()
    {
        $this->reset(['result', 'message']);

        $data = $this->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'El e-mail es obligatorio',
            'email.email' => 'E-mail no válido'
        ]);

        $data['email'] = Str::lower(trim($data['email']));

        //Encontra el usuario por su email
        $user = User::query()->where('email', $data['email'])->where('confirmed', true)->first();

        if (!$user) {
            return $this->addError('email', 'El usuario no existe');
        }

        $this->reset(['email']);

        //Llenar con informacion del usuario
        return $this->result = $user;
    }

    public function addMember()
    {
        $this->reset(['message']);

        //Verificar si el usuario existe y el proyecto
        if (!$this->result || !$this->project) {
            return $this->message = 'Hubo un error';
        }

        //Verificar que no te estas agregando a ti mismo
        if ($this->result->is(Auth::user())) {
            return $this->message = 'No puedes agregarte a ti mismo';
        }

        //Verificar si el usuario es el manager
        $this->authorize('create', [Team::class, $this->project]);

        //Verificar si el usuario ya esta en el proyecto y si no, se crea
        try {
            $this->project->team()->create([
                'user_id' => $this->result->id,
                'role_id' => 1
            ]);
        } catch (\Throwable $th) {
            return $this->message = 'El usuario ya está en el proyecto';
        }

        //Vaciar informacion
        $this->reset(['result']);

        //Cerrar el modal
        Flux::modal('find-user')->close();

        //Enviar evento para actualizar miembros del proyecto
        $this->dispatch('refreshMembers');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Miembro agregado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.projects.modals.find-user-modal');
    }
}
