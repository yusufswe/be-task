<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', action: [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/divisions', action: [DivisionController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employees', [EmployeeController::class, 'addEmployee']);
    Route::put('/employees/{employee}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/employees/{employee}', [EmployeeController::class, 'deleteEmployee']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
