<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JotController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [JotController::class, 'home']);
Route::get('sign-in', [JotController::class, 'sign_in']);
Route::post('/', [JotController::class, 'create']);
