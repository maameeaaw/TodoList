<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use App\Models\Task;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/taskAll',[TaskController::class,'index'])->name('taskAll');
    Route::get('/task/edit/{id}',[TaskController::class,'edit']);
    Route::get('/task/done/{id}',[TaskController::class,'Todone']);
    Route::get('/task/done',[TaskController::class,'done'])->name('taskDone');
    Route::post('/Task/add',[TaskController::class,'store'])->name('addTask');
    Route::post('/task/update/{id}',[TaskController::class,'update']);
});
