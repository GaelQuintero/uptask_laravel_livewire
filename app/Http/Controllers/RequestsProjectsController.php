<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\View\View;

class RequestsProjectsController extends Controller
{
    public function index(): View
    {
        return view('requests.index');
    }

    public function view(Request $request): View
    {
        return view('requests.view', [
            'request' => $request
        ]);
    }
}
