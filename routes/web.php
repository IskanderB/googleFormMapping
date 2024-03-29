<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RowController;
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
    Route::post('/task/{currentTask}/remove', [TaskController::class, 'remove'])->name('task.remove');
    Route::post('/task/{currentTask}/layouts/{layout}/remove', [TaskController::class, 'removeLayout'])->name('task.layout.remove');

    Route::get('/dashboard/{currentTask?}', [DashboardController::class, 'dashboard'])->name('dashboard')->defaults('currentTask', null);

    Route::post('row/{row}/documents/generate', [RowController::class, 'generate'])->name('row.documents.generate');
    Route::post('row/documents/generate-multiple', [RowController::class, 'generateMultiple'])->name('row.documents.generate.multiple');
    Route::post('row/{row}/documents/remove', [RowController::class, 'removeDocuments'])->name('row.documents.remove');
    Route::post('row/documents/remove-multiple', [RowController::class, 'removeDocumentsMultiple'])->name('row.documents.remove.multiple');

    Route::get('/files/{file}/show', [FileController::class, 'show'])->name('file.show');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('file.download');

});

require __DIR__.'/auth.php';
