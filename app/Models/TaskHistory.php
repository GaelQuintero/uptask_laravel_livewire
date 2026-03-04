<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskHistory extends Model
{
     protected $table = 'task_history';

    protected $fillable = [
        'task_id',
        'user_id',
        'new_status',
    ];

    public function task() : BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

     public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
