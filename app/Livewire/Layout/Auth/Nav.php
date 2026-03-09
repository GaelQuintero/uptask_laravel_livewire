<?php

namespace App\Livewire\Layout\Auth;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Nav extends Component
{
    public bool $openNav = false;

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
