<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Posts\PostController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Comment\ComentController;
use App\Http\Controllers\Api\Likes\LikeController;
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

Route::patch('/profile/edit',[UserController::class, 'updateUserData'])->middleware('auth:sanctum'); // Запись  отредактированных данных (только с токеном)

Route::get('/posts', [PostController::class, 'getPosts']); // Получить все посты
Route::post('/posts/create', [PostController::class, 'createPost'])->middleware('auth:sanctum');//Создать пост
Route::get('/posts/{id}', [PostController::class, 'getPostData']);

Route::get('/profile',[UserController::class, 'getProfileData'])->middleware('auth:sanctum'); //Выдача инфомрации о пользователе (только с токеном)
Route::get('/profile/userPosts',[UserController::class, 'getUserPosts'])->middleware('auth:sanctum'); //Выдача постов пользователяи (только с токеном)
Route::get('/profile/userLikedPosts',[UserController::class, 'getUserLikedPosts'])->middleware('auth:sanctum'); //Выдача пролайканных постов (только с токеном)

Route::get('/comments', [ComentController::class, 'getComments']); // Получить все коментарии к конкретному посту
Route::get('/getComments', [ComentController::class, 'getPostComments']); // Получить все коментарии к конкретному посту

Route::get('/likes', [LikeController::class, 'getPostLikes']); // Получить все лайки на посте
Route::get('/likes/add', [LikeController::class, 'addPostLikes'])->middleware('auth:sanctum'); // Поставить лайк (только с токеном)
