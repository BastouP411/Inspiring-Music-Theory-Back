<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['App\Http\Middleware\Cors', 'App\Http\Middleware\ForceJsonResponse']], function () {
    // ...

    //public routes
    Route::post('/login', [Auth\ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [Auth\ApiAuthController::class, 'register'])->name('register.api');

});

Route::middleware('auth:api')->group(function (){
    // our routes to be protected will go in here
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
});
