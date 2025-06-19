<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class,'home'])->name('home');
    Route::get('/logs', [HomeController::class,'activityLogs'])->name('activityLogs');
    Route::get('/auto', [HomeController::class,'automaticControl'])->name('automaticControl');
    Route::get('/live', [HomeController::class,'liveStream'])->name('liveStream');
    Route::get('/status', [HomeController::class,'carStatus'])->name('carStatus');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class,'loginPage'])->name('loginPage');
    Route::post('/login', [AuthController::class,'login'])->name('login');
});


//Route::get('/register', [AuthController::class,'registerPage'])->name('registerPage');
//Route::post('/register', [AuthController::class,'register'])->name('register');
