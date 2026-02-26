<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\StatisticsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/users',[UsersController::class, 'index'])->name('users');
    Route::post('/users/{user}/toggle-ban',[UsersController::class, 'toggleBan'])->name('users.toggle-ban');


    Route::get('/statistics',[StatisticsController::class, 'index'])->name('statistics');
});

require __DIR__.'/auth.php';
