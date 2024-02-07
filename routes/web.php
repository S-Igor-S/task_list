<?php

use App\Http\Controllers\TaskController;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
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

Route::view('/create', 'create')->name('tasks.create');

Route::get('/', [TaskController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'list'])->name('tasks.index');
Route::get('/tasks/{task}', [TaskController::class, 'single'])->name('tasks.show');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

Route::post('/tasks', [TaskController::class, 'create'])->name('tasks.store');

Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::put('tasks/{task}/toggle-complete', [TaskController::class, 'complete'])->name('tasks.toggle-complete');

Route::delete('/tasks/{task}', [TaskController::class, 'delete'])->name('tasks.destroy');
