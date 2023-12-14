<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BoardController;
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

// Route::get('/', [BoardController::class, 'index'])->middleware('auth');

Route::resource('/', BoardController::class)->middleware('auth');

Route::get('/board/checkSlug', [BoardController::class, 'checkSlug'])->middleware('auth');
Route::resource('board', BoardController::class)->middleware('auth');


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// routes/web.php

Route::resource('{board_slug}', TaskController::class)->middleware('auth');
Route::resource('{board_slug}/{task_slug}', TaskController::class)->middleware('auth');
