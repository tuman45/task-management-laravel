<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BoardController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/{board:board_slug}', [BoardController::class, 'showTask']);
Route::get('/{board:board_slug}/{task:task_slug}', [TaskController::class, 'showDetail']);
