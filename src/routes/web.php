<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviePlayerController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MoviePlayerController::class, 'index'])->name('movie.index');
Route::get('/films/play', [MoviePlayerController::class, 'play'])->name('movie.play');
