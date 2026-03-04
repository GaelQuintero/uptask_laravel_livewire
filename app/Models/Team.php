<?php

namespace App\Models;

use App\Policies\TeamPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(TeamPolicy::class)]
class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'project_id',
        'user_id',
        'role_id',
    ];

     public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'created_by');
    }

    public function task_history(): HasMany
    {
        return $this->hasMany(TaskHistory::class, 'user_id');
    }

}
