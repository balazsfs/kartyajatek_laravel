<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/', function () {return view('welcome');});

Route::get('/characters',[CharacterController::class,'index'])->name('characters.index');
Route::get('/characters/create',[CharacterController::class,'create'])->name('characters.create');
Route::get('/characters/{character}',[CharacterController::class,'show'])->name('characters.show');
Route::post('/characters',[CharacterController::class,'store'])->name('characters.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
