<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [Controller::class, 'index'])->name('dashboard.home');
    Route::get('/profile', [Controller::class, 'profile'])->name('profile.page');
    Route::patch('/updateInfo', [Controller::class, 'updateInformation'])->name('updateInfo');
});



Route::resource('/blog', BlogController::class)->middleware('auth');
Route::middleware(['role:admin'])->group(function () {
    Route::resource('/user', UserController::class);
});
