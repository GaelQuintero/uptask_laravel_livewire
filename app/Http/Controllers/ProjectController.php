<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Project $project)
    {
        if(!$project->team()->where('user_id', Auth::id())->exists() && Auth::id() !== $project->manager) {
            abort(401, 'No tienes acceso a este proyecto');
        }
        return view('projects.view', [
            'project' => $project
        ]);
    }
}
