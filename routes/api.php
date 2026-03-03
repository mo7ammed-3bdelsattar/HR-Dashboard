<?php

use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{name}/{uid}', [CompanyController::class, 'show']);
