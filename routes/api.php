<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ping',function (Request $request) {
    return ['pong' => true]; 
});

Route::post('/todo',[ApiController::class,'createTodo']);
Route::get('/todos',[ApiController::class,'readAllTodos']);
Route::get('/todos/{id}',[ApiController::class,'readTodo']);
Route::put('/todo/{id}',[ApiController::class,'updateTodo']);
Route::delete('/todo/{id}',[ApiController::class,'deleteTodo']);