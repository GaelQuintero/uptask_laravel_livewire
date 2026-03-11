<?php

namespace App\Livewire\Layout\Auth;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use SweetAlert2\Laravel\Traits\WithSweetAlert;

class Nav extends Component
{
    use WithSweetAlert;
    public $userId;
    public bool $openNav = false;


    public function mount()
    {
        $this->userId = Auth::id();
    }

    public function toggleMenu()
    {
        $this->openNav = !$this->openNav;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return $this->redirect('/login');
    }

    public function profile()
    {
        return $this->redirect('/profile', navigate: true);
    }

    public function requests()
    {
        return $this->redirect('/requests', navigate: true);
    }


    #[On('echo-private:users.{userId},notification.received')]
    public function showAlertNotification()
    {
        //Mostrar mensaje success
        $this->swalSuccess([
            'title' => "Tienes una notificación nueva",
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3500,
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);

        unset($this->getRequests);
    }

    #[Computed()]
    public function getRequests()
    {
        return Request::query()
            ->where('destination_id', Auth::id())
            ->count();
    }


    public function render()
    {
        return view('livewire.layout.auth.nav');
    }
}
