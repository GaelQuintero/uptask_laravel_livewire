<?php

namespace App\Livewire\Auth\Tasks\Modals;

use App\Models\Task;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class EditTask extends Component
{
    use WithSweetAlert;
    public Task $task;

    public $name;
    public $description;


    public function mount($task)
    {
        $this->task = $task;
        $this->name = $task->name;
        $this->description = $task->description;
    }

    public function editTask()
    {
        //Verificar si el usuario puede editar una tarea
        $this->authorize('update', $this->task);

        $data = $this->validate([
            'name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => 'El nombre de la tarea es obligatorio',
            'description.required' => 'La descripción es obligatoria'
        ]);

        //Actualizar tarea
        $this->task->update([
            'name' =>  $data['name'],
            'description' => $data['description'],
        ]);

        //Cerrar modal
        Flux::modal('edit-task-' . $this->task->id)->close();

        //Enviar evento para actualizar tareas
        $this->dispatch('refreshTasks');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Tarea actualizada correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.tasks.modals.edit-task');
    }
}
