<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GithubLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//redirect to the github login page 
Route::get('login/github', [GithubLoginController::class, 'redirect']);

Route::get('login/github/callback', [GithubLoginController::class, 'callback']);

//redirect to the google login page 
Route::get('login/google', [GoogleController::class, 'redirect']);

Route::get('login/google/callback', [GoogleController::class, 'callback']);