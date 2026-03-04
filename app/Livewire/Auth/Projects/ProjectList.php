<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ProjectList extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('project-created')]
    #[On('project-deleted')]
    #[On('project-updated')]
    public function getAllProjects()
    {
        return Project::query()
        ->where('manager', Auth::id())->orderBy('created_at', 'DESC')
        ->orWhereHas('team', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->simplePaginate(5);
    }

    public function render()
    {
        return view('livewire.auth.projects.project-list', [
            'projects' => $this->getAllProjects()
        ]);
    }
}
