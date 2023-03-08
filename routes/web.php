<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::match(['get', 'post'],'/task/{task?}', [TaskController::class, 'task'])->name('task')->defaults('task', null);
    Route::post('/task/{currentTask}/refresh', [TaskController::class, 'refresh'])->name('task.refresh');

    Route::get('/dashboard/{currentTask?}', [DashboardController::class, 'dashboard'])->name('dashboard')->defaults('currentTask', 15);
});

require __DIR__.'/auth.php';
