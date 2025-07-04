<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/play', [UserController::class, 'play'])->name('play');


    Route::get('/kabanata-una', [UserController::class, 'kabanata_una'])->name('kabanata_una');
    Route::post('/update-status', [UserController::class, 'updateStatus'])->name('update.status');
    Route::get('/chapter/inside-house', [UserController::class, 'insideHouse'])->name('chapter.inside_house');


});





Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
