<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/{locale}', [HomeController::class, 'index'])->where('locale', 'en|fa');
