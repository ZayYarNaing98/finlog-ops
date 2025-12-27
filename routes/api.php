<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinancialLogController;
use Illuminate\Support\Facades\Route;

Route::get('/finlog-categories', [CategoryController::class, 'index']);
Route::post('/finlog', [FinancialLogController::class, 'store']);
