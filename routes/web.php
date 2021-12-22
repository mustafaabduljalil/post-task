<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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
// Socialite authentication routes
Route::prefix('social-login')->name('socialLogin.')->group( function(){
    Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('login');
    Route::any('callback/{provider}', [SocialLoginController::class, 'callback'])->name('callback');
});

Route::view('/','welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);


