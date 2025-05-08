<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'startGame'])->name('start-game');
Route::post('/', [MainController::class, 'prepareGame'])->name('prepare-game');
