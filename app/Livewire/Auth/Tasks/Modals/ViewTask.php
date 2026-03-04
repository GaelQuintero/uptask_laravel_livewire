<?php

namespace App\Livewire\Auth\Tasks\Modals;

use App\Models\Task;
use App\Models\TaskHistory;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class ViewTask extends Component
{
    use WithSweetAlert, WithPagination, WithoutUrlPagination;

    public Task $task;
    public $status;

    public function mount($task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    public function formatStatus($status)
    {
        if ($status === 'pending') {
            return 'Pendiente';
        } else if ($status === 'onHold') {
            return 'En espera';
        } else if ($status === 'inProgress') {
            return 'En progreso';
        } else if ($status === 'underReview') {
            return 'En revisión';
        } else if ($status === 'completed') {
            return 'Completado';
        }
    }

    public function updateStatus()
    {
        $this->task->update([
            'status' => $this->status
        ]);

        $newStatus = $this->formatStatus($this->status);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $this->task->id,
            'user_id' => Auth::id(),
            'new_status' => $newStatus,
        ]);

        //Cerrar modal
        Flux::modal('view-task-' . $this->task->id)->close();

        //Enviar evento para actualizar tareas
        $this->dispatch('refreshTasks');

        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => 'Estatus de la tarea actualizado',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function getStatusHistory()
    {
        return TaskHistory::query()
            ->where('task_id', $this->task->id)
            ->simplePaginate(5, pageName: "historial-cambios-{$this->task->id}");
    }


    public function render()
    {
        return view('livewire.auth.tasks.modals.view-task', [
            'statusChanges' => $this->getStatusHistory()
        ]);
    }
}
