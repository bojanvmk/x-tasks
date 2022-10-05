<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function() {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('dashboard', [DashboardController::class, 'view'])->name('dashboard');
    Route::resource('tasks', TaskController::class)->except(['destroy']);

    Route::get('/user/token', function(Request $request) {
        return ['token' => $request->user()->createToken('api')->plainTextToken];
    });
});
