<?php

namespace App\Livewire\Auth\Tasks;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskHistory;
use App\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class TaskList extends Component
{
    use WithPagination, WithoutUrlPagination, WithSweetAlert;

    public Project $project;

    public function mount($project)
    {
        $this->project = $project;
    }


    public function changeStatusPending($taskId)
    {
        //Se pasa a entero el id
        $taskId = intval($taskId);

        $task = Task::with('project')->find($taskId);


        $task->update([
            'status' => TaskStatus::PENDING->value
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'new_status' => 'Pendiente',
        ]);

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

    public function changeStatusOnHold($taskId)
    {
        //Se pasa a entero el id
        $taskId = intval($taskId);

        $task = Task::with('project')->find($taskId);


        $task->update([
            'status' => TaskStatus::ON_HOLD->value
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'new_status' => 'En espera',
        ]);

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


    public function changeStatusInProgress($taskId)
    {
        //Se pasa a entero el id
        $taskId = intval($taskId);

        $task = Task::with('project')->find($taskId);


        $task->update([
            'status' => TaskStatus::IN_PROGRESS->value
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'new_status' => 'En progreso',
        ]);

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

    public function changeStatusOnReview($taskId)
    {
        //Se pasa a entero el id
        $taskId = intval($taskId);

        $task = Task::with('project')->find($taskId);


        $task->update([
            'status' => TaskStatus::UNDER_REVIEW->value
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'new_status' => 'En revisión',
        ]);

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


    public function changeStatusComplete($taskId)
    {
        //Se pasa a entero el id
        $taskId = intval($taskId);

        $task = Task::with('project')->find($taskId);


        $task->update([
            'status' => TaskStatus::COMPLETE->value
        ]);

        //Agregar historial de cambios
        TaskHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'new_status' => 'Completado',
        ]);

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

    #[On('refreshTasks')]
    public function getTaskPending()
    {
        return Task::query()
            ->where('project_id', $this->project->id)
            ->where('status', TaskStatus::PENDING->value)
            ->simplePaginate(3, pageName: 'taskPending-page');
    }

    #[On('refreshTasks')]
    public function getTaskOnHold()
    {
        return Task::query()
            ->where('project_id', $this->project->id)
            ->where('status', TaskStatus::ON_HOLD->value)
            ->simplePaginate(3, pageName: 'taskOnHold-page');
    }

    #[On('refreshTasks')]
    public function getTaskInProgress()
    {
        return Task::query()
            ->where('project_id', $this->project->id)
            ->where('status', TaskStatus::IN_PROGRESS->value)
            ->simplePaginate(3, pageName: 'taskInProgress-page');
    }

    #[On('refreshTasks')]
    public function getTaskUnderReview()
    {
        return Task::query()
            ->where('project_id', $this->project->id)
            ->where('status', TaskStatus::UNDER_REVIEW->value)
            ->simplePaginate(3, pageName: 'taskUnderReview-page');
    }

    #[On('refreshTasks')]
    public function getTaskCompleted()
    {
        return Task::query()
            ->where('project_id', $this->project->id)
            ->where('status', TaskStatus::COMPLETE->value)
            ->simplePaginate(3, pageName: 'taskCompleted-page');
    }

    public function render()
    {
        return view('livewire.auth.tasks.task-list', [
            'tasksPending' => $this->getTaskPending(),
            'tasksOnHold' => $this->getTaskOnHold(),
            'tasksInProgress' => $this->getTaskInProgress(),
            'tasksUnderReview' => $this->getTaskUnderReview(),
            'tasksCompleted' => $this->getTaskCompleted()
        ]);
    }
}
