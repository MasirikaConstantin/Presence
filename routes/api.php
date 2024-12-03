<?php

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\GestionConnexion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PresenceController;
use App\Http\Controllers\Api\V1\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/posts",[PostController::class, "index"]);

//Route::post("/new/posts",[PostController::class, "store"]);



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});

Route::post('/login', [GestionConnexion::class, 'login']);
Route::post('/logout', [GestionConnexion::class, 'logout'])->middleware('auth:sanctum');
Route::post('/register', [GestionConnexion::class, 'register']);
Route::put('/user', [GestionConnexion::class, 'update'])->middleware('auth:sanctum');
Route::delete('/user', [GestionConnexion::class, 'delete'])->middleware('auth:sanctum');
Route::get('/reaction/{post}', [PostController::class, 'Reaction'])->middleware('auth:sanctum');



Route::post('/presences', [PresenceController::class, 'store']);


Route::get('/presences/verifie', [PresenceController::class, 'checkTodayPresence']);


Route::get('user/{utilisateur}', [UserController::class,"voir"])->name('voir');
