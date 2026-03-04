<?php

namespace App\Livewire\Auth\Projects\Modals;

use App\Models\Project;
use App\Models\Role;
use App\Models\Team;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class MembersModal extends Component
{
    use WithSweetAlert;
    public Project $project;

    public array $roles = [];

    public $showMessage = false;

    public $message = '';
    public $type = '';

    public function mount($project)
    {
        $this->project = $project;
        foreach ($this->getMembersByProject()->get() as $member) {
            $this->roles[$member->id] = $member->role_id;
        }
    }

    #[On('refreshMembers')]
    public function getMembersByProject()
    {
        return Team::query()
            ->where('project_id', $this->project->id);
    }

    public function openModalMemberDelete(Team $member)
    {
        Flux::modal('show-members')->close();
        if (!$member) {
            $this->swalError([
                'title' => 'ID no válido',
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3500,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }

        //Si existe el miembro, se envia el evento
        $this->dispatch('openModalMemberDelete', idMember: $member->id)->to(component: DeleteMemberModal::class);
    }

    public function openModalMember()
    {
        Flux::modal('show-members')->close();
        $this->dispatch('openModalTeam');
    }

    #[Computed]
    public function getRoles()
    {
        return Role::query()
            ->select('id', 'name')
            ->get();
    }

    public function changeRole(Team $member)
    {
        $this->reset(['showMessage', 'message', 'type']);

        //Verificar si el usuario tiene permisos
        $this->authorize('update', $this->project);

        $roleId = $this->roles[$member->id];

        //Verificar si el usuario pertence al proyecto
        if (!$member->project_id === $this->project->id) {
            $this->showMessage = true;
            $this->type = 'error';
            $this->message = 'Ocurrio un error, intentalo más tarde';
            return;
        }

        //Si todo esta bien, se actualiza el status
        Team::query()->where('id', $member->id)
                ->update(['role_id' => $roleId]);

        //Mostrar mensaje de exito
        $this->showMessage = true;
        $this->type = 'success';
        $this->message = "El rol de {$member->user->name} se ha actualizado correctamente 🎉";
    }

    public function hiddenMessage()
    {
        $this->reset(['showMessage', 'message', 'type']);
    }


    public function render()
    {
        return view('livewire.auth.projects.modals.members-modal', [
            'members' => $this->getMembersByProject()->simplePaginate(5, pageName: 'members-page'),
            'totalMembers' => $this->getMembersByProject()->count()
        ]);
    }
}
