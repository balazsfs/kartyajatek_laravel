<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\GameController;

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/characters',[CharacterController::class,'index'])->name('characters.index');
Route::get('/characters/create',[CharacterController::class,'create'])->name('characters.create');
Route::get('/characters/{character}',[CharacterController::class,'show'])->name('characters.show');
Route::post('/characters',[CharacterController::class,'store'])->name('characters.store');
Route::get('/characters/{character}/edit',[CharacterController::class,'edit'])->name('characters.edit');
Route::patch('/characters/{character}',[CharacterController::class,'update'])->name('characters.update');
Route::delete('/characters/{character}',[CharacterController::class,'destroy'])->name('characters.destroy');

Route::get('/places',[PlaceController::class,'index'])->name('places.index');
Route::get('/places/create',[PlaceController::class,'create'])->name('places.create');
Route::post('/places',[PlaceController::class,'store'])->name('places.store');
Route::get('/places/{place}/edit',[PlaceController::class,'edit'])->name('places.edit');
Route::patch('/places/{place}',[PlaceController::class,'update'])->name('places.update');
Route::delete('/places/{place}',[PlaceController::class,'destroy'])->name('places.destroy');


Route::get('/games/{game}',[GameController::class,'show'])->name('games.show');
Route::post('/games/{game}',[GameController::class,'attack'])->name('games.attack');
Route::post('/games',[GameController::class,'store'])->name('games.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
