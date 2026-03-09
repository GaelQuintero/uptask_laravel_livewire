<?php

namespace App\Livewire\Auth\Requests;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RequestView extends Component
{
    public Request $request;
    public $showMessage = false;
    public $message = '';

    public function mount(Request $request)
    {
        $this->request = $request;
    }

    public function verifyUserRequest()
    {
        
        if (!$this->request->exists) {
            $this->showMessage = true;
            return $this->message = 'La invitación no existe';
        }

        if (!$this->request->project?->exists) {
            $this->showMessage = true;
            return $this->message = 'El proyecto ya no existe';
        }

        if ($this->request->destination_id !== Auth::id()) {
            $this->showMessage = true;
            return $this->message = 'Acción no válida';
        }

        if ($this->request->project->team()->where('user_id', Auth::id())->exists()) {
            $this->request->delete();
            return $this->redirectRoute('dashboard', navigate: true);
        }

        return true;
    }

    public function accept()
    {
        $this->reset(['showMessage', 'message']);

        if (!$this->verifyUserRequest()) return;

        $project = $this->request->project;

        DB::transaction(function () use ($project) {
            $project->team()->create([
                'user_id' => Auth::id(),
                'role_id' => 1
            ]);

            $this->request->delete();
        });

        $this->redirect('/dashboard', navigate: true);
    }

    public function decline()
    {
        $this->reset(['showMessage', 'message']);

        if (!$this->verifyUserRequest()) return;

        $this->request->delete();

        $this->redirect('/dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.requests.request-view');
    }
}
