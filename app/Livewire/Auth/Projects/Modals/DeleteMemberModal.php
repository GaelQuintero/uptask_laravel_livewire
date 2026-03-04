<?php

namespace App\Livewire\Auth\Projects\Modals;

use App\Models\Project;
use App\Models\Team;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class DeleteMemberModal extends Component
{
    use WithSweetAlert;
    public Project $project;
    public ?Team $member = null;

    public function mount($project)
    {
        $this->project = $project;
    }

    #[On('openModalMemberDelete')]
    public function openModal($idMember)
    {
        //Asignar el miembro del equipo
        $this->member = Team::query()->find($idMember);

        if (!$this->member) {
            $this->swalError([
                'title' => 'No se encontro al colaborador',
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3500,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }
        //Se abre el nuevo modal
        Flux::modal('deleteMember')->show();
    }

    public function deleteMember()
    {
        //Verificar si el miembro sigue
        if (!$this->member) {
            $this->swalError([
                'title' => 'No se encontro al colaborador',
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3500,
                'showConfirmButton' => false,
                'timerProgressBar' => true,
            ]);
            return;
        }

        //Verificar si el usuario tiene permisos
        $this->authorize('delete', $this->project);

        DB::transaction(function () {
            //Eliminar notas si las tiene
            $this->member->notes()->delete();

            //Eliminar historial si lo tiene
            $this->member->task_history()->delete();

            //Eliminar al miembro
            $this->member->delete();
        });

        Flux::modal('deleteMember')->close();

        //Actualizar query de colaboradores
        $this->dispatch('refreshMembers');

        $this->reset(['member']);

        $this->swalSuccess([
            'title' => 'Colaborador eliminado correctamente',
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function closeModal()
    {
        $this->reset(['member']);
        Flux::modal('deleteMember')->close();
        Flux::modal('show-members')->show();
    }
    public function render()
    {
        return view('livewire.auth.projects.modals.delete-member-modal');
    }
}
