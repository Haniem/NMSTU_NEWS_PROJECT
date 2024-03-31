<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']); // Регистрация пользователя
Route::post('/auth/login', [AuthController::class, 'login']); // Проверка данных для фхода и создания токена для доступа к данным пользователя
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Удаления персонального  токена для доступа к данным

