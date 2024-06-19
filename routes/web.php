<?php

use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');
/*
Route::get('users', [
    'uses' => 'App\Http\Controllers\UsersController@show',
    'as'   => 'users.show'
]);
*/
Route::middleware('auth')->group(function () {
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [App\Http\Controllers\UsersController::class, 'create'])->name('users.create');
    Route::post('/create', [App\Http\Controllers\UsersController::class, 'store'])->name('users.create');
    Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
    Route::post('/update', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('/trashed', [App\Http\Controllers\UsersController::class, 'trashed'])->name('users.trashed');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
