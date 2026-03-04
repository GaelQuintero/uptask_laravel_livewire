<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Project $project)
    {
        return view('projects.view', [
            'project' => $project
        ]);
    }
}
