<?php

use App\Exceptions\CustomHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request; // Import class Request yang benar

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware configuration
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Register custom exception handler
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return app(CustomHandler::class)->render($request, $e);
        });
    })->create();

// use App\Exceptions\CustomHandler;
// use Illuminate\Auth\AuthenticationException;
// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Exceptions;
// use Illuminate\Foundation\Configuration\Middleware;
// use Illuminate\Http\Request;

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         web: __DIR__ . '/../routes/web.php',
//         api: __DIR__ . '/../routes/api.php',
//         commands: __DIR__ . '/../routes/console.php',
//         health: '/up',
//     )
//     ->withMiddleware(function (Middleware $middleware) {
//         //
//     })
//     ->withExceptions(function (Exceptions $exceptions) {
//         // Register custom exception handler
//         $exceptions->render(function (AuthenticationException $e, Request $request) {
//             return app(CustomHandler::class)->render($request, $e);
//         });
//     })->create();

// ->withExceptions(function (Exceptions $exceptions) {
//     $exceptions->render(function (AuthenticationException $e, $request) {
//         return app(CustomHandler::class)->render($request, $e);
//     });
// })->create();
