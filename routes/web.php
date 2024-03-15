<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;

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



route::prefix('home')->name('home.')->group(function(){
    route::get('/',[ManagerController::class, 'index'])->name('index');
    route::get('/add',[ManagerController::class, 'add'])->name('add');
    route::post('/add',[ManagerController::class, 'postAdd'])->name('postadd');
    route::get('/edit/{id}',[ManagerController::class, 'getEdit'])->name('edit');
    Route::match(['get', 'post'], '/update',[ManagerController::class, 'postEdit'])->name('postEdit');
    route::get('/delete/{id}',[ManagerController::class, 'deleteUser'])->name('delete');
});
