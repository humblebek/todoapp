<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', [Controller::class, "index"])->name("index");

Route::middleware('auth')->group(function () {
    Route::get('/', [Controller::class, "index"])->name("index");
    Route::resource("tasks", TaskController::class);

});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-post',[AuthController::class,'loginPost'])->name('login-post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
