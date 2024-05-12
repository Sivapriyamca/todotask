<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('user', [AuthController::class,'user']);
// Route::middleware('auth:sanctum')->get('getprojectlist', [ProjectController::class,'projectlist']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class,'logout']);
Route::get('getprojectlist', [ProjectController::class,'projectlist'])->name('projectlist');
Route::post('addproject', [ProjectController::class,'addproject']);
Route::put('editprojectname/{id}', [ProjectController::class,'editprojectname']);
Route::delete('deleteproject/{id}', [ProjectController::class,'deleteproject']);
Route::get('gettodolist', [TodoController::class,'todolist'])->name('todolist');
Route::post('addtodo', [TodoController::class,'addtodo'])->name('addtodo');
Route::put('updatetodo/{id}', [TodoController::class,'updatetodo']);
Route::delete('tododelete/{id}', [TodoController::class,'tododelete']);
Route::get('projectwisetasks/{id}', [TodoController::class,'projectwisetasks'])->name('tasks');
Route::post('/login',[AuthController::class,'loginfunction'])->name('login');