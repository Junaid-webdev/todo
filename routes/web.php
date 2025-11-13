<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/',[AuthController::class,'login'])->name('auth.login');


Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'],function(){
    Route::get('/home', function () {
        return view('welcome');
    })->name('home');

    Route::get('/todo', [AuthController::class, 'index'])->name('todo');
    Route::get('/create', function () {
        return view('create');
    })->name('create');
    Route::post('/create', [AuthController::class, 'store'])->name('todo.store');
    Route::get('/edit/{id}', [AuthController::class, 'edit'])->name('edit');
    Route::post('/update', [AuthController::class, 'update'])->name('todo.update');
    Route::get('/delete/{id}', [AuthController::class, 'delete'])->name('todo.delete');
});
