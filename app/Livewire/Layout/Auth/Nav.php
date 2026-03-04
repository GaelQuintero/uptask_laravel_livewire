<?php

namespace App\Livewire\Layout\Auth;

use Illuminate\Support\Facades\Auth;
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
        return $this->redirect('/profile');
    }


    public function render()
    {
        return view('livewire.layout.auth.nav');
    }
}
