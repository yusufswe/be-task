<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'addEmployee']);
    Route::put('/employees/{employee}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/employees/{employee}', [EmployeeController::class, 'deleteEmployee']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
