<?php

namespace App\Livewire\Auth\Tasks;

use App\Models\Project;
use App\Models\Team;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskActions extends Component
{
    public Project $project;
    public $totalMembers = 0;

    public function mount($project)
    {
        $this->project = $project;
        $this->getTotalMembers();
    }

    #[On('openModalTeam')]
    public function openModalTeam()
    {
        Flux::modal('find-user')->show();
    }

    public function openModalTaskCreate()
    {
        Flux::modal('create-task')->show();
    }

    public function openModalMembers()
    {
        Flux::modal('show-members')->show();
    }

    #[On('refreshMembers')]
    public function getTotalMembers()
    {
         $this->totalMembers = Team::query()->where('project_id', $this->project->id)->count();
         return;
    }

    #[On('refreshMembers')]
    public function getMembers()
    {
        return Team::query()->select('id', 'project_id', 'user_id')->where('project_id', $this->project->id)->limit(3)->latest()->get();
    }

    public function render()
    {
        return view('livewire.auth.tasks.task-actions', [
            'members' => $this->getMembers()
        ]);
    }
}
