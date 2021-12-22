<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\HomeController;

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

Auth::routes();
Route::view('/','welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Socialite authentication routes
Route::prefix('social-login')->name('socialLogin.')->group( function(){
    Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('login');
    Route::any('callback/{provider}', [SocialLoginController::class, 'callback'])->name('callback');
});
