<?php

namespace App\Livewire\Auth\Requests;

use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RequestsList extends Component
{
    #[Computed()]
    public function getRequets()
    {
        return Request::query()
            ->where('destination_id', Auth::id())
            ->simplePaginate(5);
    }

    public function viewRequest($requestId = null)
    {
        return $this->redirectRoute('view-request', ['request' => $requestId], navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.requests.requests-list');
    }
}
