<?php

namespace App\Models;

use App\Policies\ProjectPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(ProjectPolicy::class)]
class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'client_name',
        'description',
        'manager'
    ];

    public function manager() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function team(): HasMany
    {
        return $this->hasMany(Team::class, 'project_id');
    }

     public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id');
    }

}
