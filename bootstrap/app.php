<?php

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\InvalidVerificationLinkException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->prepend(HandleCors::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(
            fn(InvalidCredentialsException $e) =>
            response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode())
        );

        $exceptions->render(
            fn(InvalidVerificationLinkException $e) =>
            response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode())
        );

    })->create();
