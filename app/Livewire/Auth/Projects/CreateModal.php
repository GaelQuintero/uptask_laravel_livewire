<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Project;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class CreateModal extends Component
{
    use WithSweetAlert;
    public $project_name;
    public $client_name;
    public $description;

    protected function rules()
    {
        return [
            'project_name' => ['required', Rule::unique('projects', 'project_name')->where('manager', Auth::id())],
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

    public function createProject()
    {
        $dataProject = $this->validate();

        //crear proyecto
        Project::create([
            'project_name' => $dataProject['project_name'],
            'client_name' => $dataProject['client_name'],
            'description' => $dataProject['description'],
            'manager' => Auth::id()
        ]);

        //Resetear formulario
        $this->reset(['project_name', 'client_name', 'description']);

        //Cerrar el modal
        Flux::modal('createProject')->close();

        //Enviar evento para actualizar los proyectos
        $this->dispatch('project-created');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Proyecto creado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.projects.create-modal');
    }
}
