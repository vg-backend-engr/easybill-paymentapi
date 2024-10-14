<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
// Route for listing all users
// Route::get('api/users', [UserController::class, 'index']);

