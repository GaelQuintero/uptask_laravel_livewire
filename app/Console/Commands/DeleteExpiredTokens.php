<?php

namespace App\Console\Commands;

use App\Models\Token;
use Illuminate\Console\Command;

class DeleteExpiredTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Token::query()->where('expires_at', '<', now())->delete();
    }
}
