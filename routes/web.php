<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///category routes
Route::get('/', [CategoryController::class, 'index'])->name('categoryindex');
Route::Post('categorystore', [CategoryController::class, 'store'])->name('categorystore');

/////popst routes////

Route::get('index', [PostController::class, 'index'])->name('index');
Route::get('create', [PostController::class, 'create'])->name('create');
Route::Post('poststore', [PostController::class, 'store'])->name('poststore');
Route::delete('destroy/{id}', [PostController::class, 'destroy'])->name('destroy');
Route::get('edit/{postid}', [PostController::class, 'edit'])->name('edit');
Route::patch('update/{postid}', [PostController::class, 'update'])->name('update');
