<?php

namespace App\Livewire\Auth\Tasks;

use App\Models\Project;
use App\Models\Task;
use Flux\Flux;
use Livewire\Component;

class OptionsTask extends Component
{
    public Task $task;
    public Project $project;

    public function mount($task, $project)
    {
        $this->task = $task;
        $this->project = $project;
    }

    public function viewTask()
    {
        Flux::modal('view-task-'. $this->task->id)->show();
    }

    public function openDeleteModal()
    {
        Flux::modal('delete-task-'. $this->task->id)->show();
    }

    public function openEditModal()
    {
        Flux::modal('edit-task-'. $this->task->id)->show();
    }

    public function viewNotes()
    {
        Flux::modal('view-notes-'. $this->task->id)->show();
    }

    public function render()
    {
        return view('livewire.auth.tasks.options-task');
    }
}
