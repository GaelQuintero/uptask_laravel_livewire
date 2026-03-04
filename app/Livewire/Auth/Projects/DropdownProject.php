<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Project;
use Flux\Flux;
use Livewire\Attributes\Locked;
use Livewire\Component;

class DropdownProject extends Component
{
    #[Locked]
    public $projectId;
    public $project;

    public function mount($projectId)
    {
        $this->projectId = $projectId;
        $this->project = Project::find($this->projectId);
    }

    public function viewProject()
    {
        $this->redirectRoute('view-project', ['project' => $this->projectId]);
    }

    public function openDeleteModal()
    {
       Flux::modal('delete-project-'. $this->projectId)->show();
    }

    public function openEditModal()
    {
        Flux::modal('edit-project-'. $this->projectId)->show();
    }


    public function render()
    {
        return view('livewire.auth.projects.dropdown-project');
    }
}
