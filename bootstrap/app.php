<?php

use App\Console\Commands\DeleteExpiredTokens;
use App\Http\Middleware\VerifyAuthUser;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(([
            'verify.auth' => VerifyAuthUser::class
        ]));
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command(new DeleteExpiredTokens)->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
