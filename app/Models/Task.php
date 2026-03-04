<?php

namespace App\Models;

use App\Policies\TaskPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UsePolicy(TaskPolicy::class)]
class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'status',
        'completed_by'
    ];

    public function completed_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function task_history(): HasMany
    {
        return $this->hasMany(TaskHistory::class);
    }
}
