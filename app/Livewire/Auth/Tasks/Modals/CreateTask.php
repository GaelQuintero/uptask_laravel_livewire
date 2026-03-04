<?php

namespace App\Livewire\Auth\Tasks\Modals;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskHistory;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class CreateTask extends Component
{
    use WithSweetAlert;

    public Project $project;

    public $name;
    public $description;

    public function mount($project)
    {
        $this->project = $project;
    }

    public function createTask()
    {
        //Verificar si el usuario puede crear una tarea
        $this->authorize('create', [Task::class,  $this->project]);

        $data = $this->validate([
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'El nombre de la tarea es obligatorio',
            'description.required' => 'La descripción es obligatoria'
        ]);


        //Crear tarea
        $task = Task::create([
            'name' =>  $data['name'],
            'description' => $data['description'],
            'project_id' => $this->project->id,
            'completed_by' => Auth::id()
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => $task->completed_by,
            'new_status' => 'Pendiente'
        ]);

        //Resetear los inputs
        $this->reset(['name', 'description']);

        //Cerrar modal
        Flux::modal('create-task')->close();

        //Enviar evento para actualizar tareas
        $this->dispatch('refreshTasks');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Tarea creada correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.tasks.modals.create-task');
    }
}
