<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ProfileNavProfile extends Component
{
    public $currentPage = 'profile';

    public function viewProfileForm()
    {
        return $this->currentPage = 'profile';
    }

    public function viewPasswordForm()
    {
        return $this->currentPage = 'changePassword';
    }

    public function render()
    {
        return view('livewire.auth.profile-nav-profile');
    }
}
