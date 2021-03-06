<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ping',function (Request $request) {
    return ['pong' => true]; 
});

Route::get('/unauthenticated',function (Request $request) {
    return ['error' => 'usuário não logado'];
})->name('login');

Route::post('/user',[AuthController::class,'create']);
Route::post('/auth',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->post('/todo',[ApiController::class,'createTodo']);
Route::get('/todos',[ApiController::class,'readAllTodos']);
Route::get('/todos/{id}',[ApiController::class,'readTodo']);
Route::put('/todo/{id}',[ApiController::class,'updateTodo']);
Route::delete('/todo/{id}',[ApiController::class,'deleteTodo']);