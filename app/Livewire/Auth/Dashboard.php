<?php

namespace App\Livewire\Auth;

use App\Models\Project;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public function openModal()
    {
        Flux::modal('createProject')->show();
    }

    #[On('project-created')]
    #[On('project-deleted')]
    public function getTotalProjects()
    {
        return Project::query()
            ->where('manager', Auth::id())
            ->orWhereHas('team', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->count();
    }


    public function render()
    {
        return view('livewire.auth.dashboard', [
            'totalProjects' => $this->getTotalProjects()
        ]);
    }
}
