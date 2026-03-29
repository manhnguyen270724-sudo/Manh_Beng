<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

// --- PHẦN AUTH (ĐĂNG NHẬP, ĐĂNG KÝ, ĐĂNG XUẤT) ---
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- PHẦN QUẢN LÝ USER (CRUD) ---

//Route::middleware('auth')->resource('users', UserController::class);

//Route::middleware('auth')->resource('products', ProductController::class);

Route::resource('/products', ProductController::class);

