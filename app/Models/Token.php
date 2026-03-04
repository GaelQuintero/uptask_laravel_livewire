<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    const CONFIRM_ACCOUNT = 'confirm_account';
    const RESET_PASSWORD  = 'reset_password';

    protected $table = 'tokens';

    protected $fillable = [
        'token',
        'type',
        'user_id',
        'expires_at'
    ];
}
