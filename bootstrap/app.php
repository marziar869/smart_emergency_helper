<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'customer/request/*/verify-pin',
            'customer/request/*/advance',
            'customer/request/*/reset',
            'customer/request/*/rate',
            'customer/request/*/upload-photo',
            'customer/emergency-request',
            'provider/request/*/status',
            'provider/request/*/advance',
            'provider/request/*/verify-pin',
            'provider/request/accept/*',
            'provider/request/*/reject',
            'provider/status',
            'provider/verification',
            'emergency-form',
            'demo-login',
            'logout',
            'demo-logout',
            'admin/provider/*/approve',
            'admin/provider/*/reject',
            'admin/user/*/toggle-status',
            'admin/category/*/toggle',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
