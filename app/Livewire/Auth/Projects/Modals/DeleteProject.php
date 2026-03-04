<?php

namespace App\Livewire\Auth\Projects\Modals;

use App\Models\Project;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Locked;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class DeleteProject extends Component
{
    use WithSweetAlert;
    #[Locked]
    public $projectId;

    public $password;

    public function mount($projectId)
    {
        $this->projectId = $projectId;
    }

    public function delete()
    {
        $credentials = $this->validate([
            'password' => 'required'
        ], [
            'password.required' => 'La contraseña es obligatoria'
        ]);

        //Verificar si la contraseña es correcta
        if (!Hash::check($credentials['password'], Auth::user()->password)) {
            return $this->addError('password', 'La contraseña es incorrecta');
        }

        //Buscar el proyecto
        $project = Project::find($this->projectId);

        //Verificar si existe el proyecto
        if (!$project) {
            return $this->addError('password', 'Proyecto no encontrado');
        }

        //Vaciar el input de password
        $this->reset(['password']);

        //Cerrar modal
        Flux::modal('delete-project-' . $project->id)->close();

        //Verificar si el usuario puede eliminarlo
        $this->authorize('delete', [Project::class, $project]);

        //Eliminar proyecto
        $project->delete();

        //Enviar evento
        $this->dispatch('project-deleted');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Proyecto eliminado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }


    public function render()
    {
        return view('livewire.auth.projects.modals.delete-project');
    }
}
