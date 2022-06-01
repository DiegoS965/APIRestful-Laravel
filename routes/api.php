<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideogameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public routes
Route::post('/register',[RegisterController::class, 'register'])->name('register');
Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::get('/products',[VideogameController::class,'index'])->name('game.index');
Route::get('/products/{id}',[VideogameController::class, 'show'])->name('game.show');
Route::get('/products/search/{title}',[VideogameController::class, 'search'])->name('game.search');

//protected routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::post('/products',[VideogameController::class,'store'])->name('game.store');
    Route::put('/products/{id}',[VideogameController::class, 'update'])->name('game.update');
    Route::delete('/products/{id}',[VideogameController::class, 'destroy'])->name('game.destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
