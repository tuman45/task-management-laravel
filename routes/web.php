<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardTaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [BoardController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Route::resource('boards', BoardController::class)->except('create', 'edit')->middleware('auth');
// Route::get('/boards/checkSlug', [BoardController::class, 'checkSlug'])->middleware('auth');

// Route::resource('boards.tasks', BoardTaskController::class)->middleware('auth');
// Route::get('/tasks/checkSlug', [BoardTaskController::class, 'checkSlug'])->middleware('auth');
// Route::put('boards/{board:board_slug}/tasks/{task:task_slug}/move', [BoardTaskController::class, 'moveToNextList'])->middleware('auth');


// custom middleware
// Board Routes
Route::get('/boards/checkSlug', [BoardController::class, 'checkSlug'])->middleware('auth');
Route::resource('boards', BoardController::class)->except('index', 'store')->middleware(['auth', 'ownership:board']);
Route::get('boards', [BoardController::class, 'index'])->middleware('auth');
Route::post('boards', [BoardController::class, 'store'])->middleware('auth');

// BoardTask Routes (Nested under boards)
Route::resource('boards.tasks', BoardTaskController::class)->middleware(['auth', 'ownership:board']);
Route::get('/tasks/checkSlug', [BoardTaskController::class, 'checkSlug'])->middleware('auth');
Route::put('boards/{board:board_slug}/tasks/{task:task_slug}/move', [BoardTaskController::class, 'moveToNextList'])->middleware(['auth', 'ownership:task']);

// Assuming 'board' and 'task' are your model names
