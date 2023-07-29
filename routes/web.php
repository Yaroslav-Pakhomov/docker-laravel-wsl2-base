<?php

use App\Http\Controllers\WorkerController;
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

Route::get('/', static function () {
    return view('welcome');
});

// CRUD
// Общая страница рабочих
Route::get('/workers', [ WorkerController::class, 'index' ])->name('workers.index');

// Страница создания рабочего
Route::get('/workers/create', [ WorkerController::class, 'create' ])->name('workers.create');
Route::post('/workers', [ WorkerController::class, 'store' ])->name('workers.store');

// Страница рабочего
Route::get('/workers/{worker}', [ WorkerController::class, 'show' ])->name('workers.show');

// Страница обновления рабочего
Route::get('/workers/{worker}/edit', [ WorkerController::class, 'edit' ])->name('workers.edit');
Route::patch('/workers/{worker}', [ WorkerController::class, 'update' ])->name('workers.update');

Route::delete('/workers/{worker}', [ WorkerController::class, 'delete' ])->name('workers.delete');
