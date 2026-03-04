<?php

namespace App\Livewire\Auth\Tasks\Modals;

use App\Models\Note;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ViewNotes extends Component
{
    use WithPagination, WithoutUrlPagination;
    public Task $task;
    public $content;

    public $showMessage = false;
    public $type = '';
    public $message = '';

    public function mount($task)
    {
        $this->task = $task;
    }

    public function createNote()
    {
        $data = $this->validate([
            'content' => 'required|max:100'
        ], [
            'content.required' => 'El contenido es obligatorio',
            'content.max' => 'El contenido no puede pasar de 100 caracteres'
        ]);

        //Crear nueva nota
        Note::create([
            'content' => $data['content'],
            'created_by' => Auth::id(),
            'task_id' => $this->task->id
        ]);

        //Vaciar formulario
        $this->reset(['content']);

        //Enviar evento a si mismo
        $this->dispatch('refreshNotes')->to(self: true);

        //Mostrar mensaje de success
        $this->showMessage = true;
        $this->type = 'success';
        $this->message = 'Nota creada correctamente 🎉';
    }

    public function deleteNote(Note $note)
    {
        if (!$note) {
            $this->showMessage = true;
            $this->type = 'error';
            $this->message = 'No se encontro la nota';
            return;
        }
        //Eliminar la nota
        $note->delete();

        //Enviar evento a si mismo
        $this->dispatch('refreshNotes')->to(self: true);

        //Mostrar mensaje de success
        $this->showMessage = true;
        $this->type = 'success';
        $this->message = 'Nota eliminada correctamente 🎉';
    }

    #[On('refreshNotes')]
    public function getNotesByTask()
    {
        return Note::query()
            ->where('task_id', $this->task->id)
            ->latest()
            ->simplePaginate(5, pageName: 'notes-page');
    }


    public function hiddenMessage()
    {
        $this->showMessage = false;
        $this->message = '';
        return;
    }

    public function render()
    {
        return view('livewire.auth.tasks.modals.view-notes', [
            'notes' => $this->getNotesByTask()
        ]);
    }
}
