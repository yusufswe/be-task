<?php
namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

class CustomHandler extends ExceptionHandler
{
    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized.',
        ], 401);
    }
}
