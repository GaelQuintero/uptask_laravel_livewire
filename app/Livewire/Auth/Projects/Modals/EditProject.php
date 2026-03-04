<?php

namespace App\Livewire\Auth\Projects\Modals;

use App\Models\Project;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class EditProject extends Component
{
    use WithSweetAlert;
    #[Locked]
    public $projectId;
    public $project;

    public $project_name;
    public $client_name;
    public $description;

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->project = Project::find($this->projectId);

        $this->project_name = $this->project->project_name;
        $this->client_name = $this->project->client_name;
        $this->description = $this->project->description;
    }

    protected function rules()
    {
        return [
            'project_name' => ['required', Rule::unique('projects', 'project_name')->where('manager', Auth::id())->ignore($this->projectId)],
            'client_name' => 'required',
            'description' => 'required'
        ];
    }

    protected function messages()
    {
        return [
            'project_name.required' => 'El nombre del proyecto es obligatorio',
            'project_name.unique' => 'Ya cuentas con un proyecto con ese nombre',
            'client_name.required' => 'El nombre del cliente es obligatorio',
            'description.required' => 'La descripción es obligatoria'
        ];
    }


    public function editProject()
    {
        $data = $this->validate();

        //Obtener proyecto
        $project = $this->project;

        if (!$project) {
            return $this->addError('project_name', 'El proyecto no existe');
        }

        //Verificar si el usuario tiene permiso de actualizar
        $this->authorize('update', $project);

        //Actualizar el proyecto
        $project->update([
            'project_name' => $data['project_name'],
            'client_name' => $data['client_name'],
            'description' => $data['description'],
        ]);

        //Cerrar modal
        Flux::modal('edit-project-'. $project->id)->close();

        //Enviar evento
        $this->dispatch('project-updated');

        //Mostrar alerta al usuario
        $this->swalSuccess([
            'title' => 'Proyecto actualizado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);

    }


    public function render()
    {
        return view('livewire.auth.projects.modals.edit-project');
    }
}
