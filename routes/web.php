<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//task

Route::get('Task',[TaskController::class,'index'])->name('task.index');
Route::get('Task/create',[TaskController::class,'create'])->name('task.create');
Route::post('Task/store',[TaskController::class,'store'])->name('task.store');
Route::get('Task/show/{id}',[TaskController::class,'show'])->name('task.show');

Route::get('Task/edit/{id}',[TaskController::class,'edit'])->name('task.edit');
Route::post('Task/Update/{id}',[TaskController::class,'update'])->name('task.update');
Route::get('Task/delete/{id}',[TaskController::class,'delete'])->name('task.delete');

});