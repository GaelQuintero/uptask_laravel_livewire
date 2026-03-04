@extends('layouts.auth')

@section('title', "{$project->project_name}")

@section('content')
<div>
    <div class="flex flex-col justify-center md:justify-start">
        <h1 class="text-4xl font-black">
            Mi Proyecto: {{ $project->project_name }}
        </h1>
    </div>

    <div class="mt-5">
        <livewire:auth.tasks.task-list :project='$project'/>
    </div>
</div>

@endsection
