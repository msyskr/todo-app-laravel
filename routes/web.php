<?php

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


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{id}', [TaskController::class, 'markAsDeleted'])->name('tasks.markAsDeleted');
Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');
Route::put('/tasks/{id}/recover', [TaskController::class, 'recover'])->name('tasks.recover');
Route::delete('/tasks/delete', [TaskController::class, 'deleteTrash'])->name('tasks.deleteTrash');

