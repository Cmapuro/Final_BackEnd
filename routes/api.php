<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/login', [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/me',       [AuthController::class, 'me']);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('courses',  CourseController::class);
    Route::prefix('dashboard')->group(function () {
        Route::get('/stats',        [DashboardController::class, 'stats']);
        Route::get('/enrollment',   [DashboardController::class, 'enrollment']);
        Route::get('/distribution', [DashboardController::class, 'distribution']);
        Route::get('/attendance',   [DashboardController::class, 'attendance']);
    });
});