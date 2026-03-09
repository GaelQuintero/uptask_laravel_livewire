<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests_projects';

    protected $fillable = [
        'destination_id',
        'project_id',
        'manager_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userDestination()
    {
        return $this->belongsTo(User::class, 'destination_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
