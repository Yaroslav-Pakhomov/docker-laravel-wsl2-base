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
Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/workers/show', [WorkerController::class, 'show']);
Route::get('/workers/create', [WorkerController::class, 'create']);
Route::get('/workers/update', [WorkerController::class, 'update']);
Route::get('/workers/delete', [WorkerController::class, 'delete']);
