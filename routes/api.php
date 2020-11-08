<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeworkController;

Route::get('/homeworks', [HomeworkController::class, 'index']);
Route::post('/homeworks', [HomeworkController::class, 'create']);
