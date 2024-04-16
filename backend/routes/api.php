<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Posts\PostController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Comment\CommentController;
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
Route::post('/auth/register', [AuthController::class, 'register']); // Регистрация пользователя
Route::post('/auth/login', [AuthController::class, 'login']); // Проверка данных для фхода и создания токена для доступа к данным пользователя
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Удаления персонального  токена для доступа к данным

Route::patch('/profile/updateUserData',[UserController::class, 'updateUserData'])->middleware('auth:sanctum'); // Запись  отредактированных данных (только с токеном)
Route::get('/profile/getProfileData',[UserController::class, 'getProfileData']); //Выдача инфомрации о пользователе (только с токеном)
Route::get('/profile/getUserPosts',[UserController::class, 'getUserPosts']); //Выдача постов пользователяи (только с токеном)
Route::get('/profile/getUserLikedPosts',[UserController::class, 'getUserLikedPosts']); //Выдача пролайканных постов (только с токеном)
//to do
Route::patch('/profile/updateUserPassword',[UserController::class, 'updateUserPassword'])->middleware('auth:sanctum'); //Выдача пролайканных постов (только с токеном)

Route::get('/posts/getAllPosts', [PostController::class, 'getPosts']); // Получить все посты
Route::post('/posts/createPost', [PostController::class, 'createPost'])->middleware('auth:sanctum');//Создать пост
//to do
Route::patch('/posts/updatePost', [PostController::class, 'updatePost']);
Route::delete('/posts/deletePost', [PostController::class, 'deletePost'])->middleware('auth:sanctum'); //Удалить пост

Route::get('/comments/getComments', [CommentController::class, 'getComments']); // Получить все коментарии к конкретному посту
//to do
Route::get('/comments/getComment', [CommentController::class, 'getComment'])->middleware('auth:sanctum');; // Обновить комментарий
Route::post('/comments/createComment', [CommentController::class, 'createComment'])->middleware('auth:sanctum');; // Обновить комментарий
Route::patch('/comments/updateComment', [CommentController::class, 'updateComment'])->middleware('auth:sanctum');; // Обновить комментарий
Route::delete('/comments/deleteComment', [CommentController::class, 'deleteComment'])->middleware('auth:sanctum');; // Удалить комментарий

Route::get('/likes/getPostLikes', [LikeController::class, 'getPostLikes']); // Получить все лайки на посте
Route::post('/likes/addLikeToPost', [LikeController::class, 'addPostLikes'])->middleware('auth:sanctum'); // Поставить лайк (только с токеном)
//to do
Route::delete('/likes/deleteLikeFromPost', [LikeController::class, 'deletePostLikes'])->middleware('auth:sanctum'); // Поставить лайк (только с токеном)
