<?php

namespace App\Livewire\Auth\Tasks\Modals;

use App\Models\Note;
use App\Models\TaskHistory;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class DeleteTask extends Component
{
    use WithSweetAlert;
    public $task;

    public $message;

    public function mount($task)
    {
        $this->task = $task;
    }

    public function deleteTask()
    {
        //Validar si existe la tarea
        if (!$this->task) {
            return $this->message = 'Hubo un error';
        }

        //Cerrar el modal
        Flux::modal('delete-task-' . $this->task->id)->close();

        //Verificar si el usuario tiene permiso para eliminar
        $this->authorize('update', $this->task);

        //Se ejecuta una transaccion, esta ves se requiere porque todo esta relacionado
        DB::transaction(function () {
            //Eliminar las notas si la tarea tiene
            $this->task->notes()->delete();

            //Verificar si tiene un historial, si si, se borra
            $this->task->task_history()->delete();

            //Eliminar tarea
            $this->task->delete();
        });

        //Disparar evento para actualizar las tareas
        $this->dispatch('refreshTasks');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Tarea eliminada correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.tasks.modals.delete-task');
    }
}
