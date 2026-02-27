<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\StatisticsController;

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettlementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('dashboard/colocation')->name('dashboard.colocation.')->group(function () {
        Route::post('/', [ColocationController::class, 'store'])->name('create');
        Route::post('/join', [ColocationController::class, 'join'])->name('join');
        Route::delete('/leave', [ColocationController::class, 'leave'])->name('leave');
        Route::delete('/cancel', [ColocationController::class, 'cancel'])->name('cancel');
        Route::patch('/invite-token', [ColocationController::class, 'regenerateInviteToken'])->name('invite-token.regenerate');
    });

    Route::post('/dashboard/expenses', [ExpenseController::class, 'store'])->name('dashboard.expenses.create');
    Route::delete('/dashboard/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('dashboard.expenses.delete');

    Route::prefix('dashboard/members')->name('dashboard.members.')->group(function () {
        Route::post('/invite', [MemberController::class, 'invite'])->name('invite');
        Route::delete('/{member}', [MemberController::class, 'destroy'])->name('delete');
    });

    Route::prefix('dashboard/categories')->name('dashboard.categories.')->group(function () {
        Route::post('/', [CategoryController::class, 'store'])->name('create');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::patch('/dashboard/settlements/{settlement}/paid', [SettlementController::class, 'markAsPaid'])->name('dashboard.settlements.paid');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/users',[UsersController::class, 'index'])->name('users');
    Route::patch('/users/{user}/toggle-ban',[UsersController::class, 'toggleBan'])->name('users.toggle-ban');

    Route::get('/statistics',[StatisticsController::class, 'index'])->name('statistics');
});

require __DIR__.'/auth.php';
