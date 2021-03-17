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

    //public data routes
    Route::get('/schools', [\App\Http\Controllers\SchoolsController::class, 'get']);
    Route::get('/users', [\App\Http\Controllers\UsersController::class, 'getAll']);

    //public auth routes
    Route::post('/login', [Auth\ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [Auth\ApiAuthController::class, 'register'])->name('register.api');

});

Route::middleware('auth:api')->group(function (){
    // our routes to be protected will go in here

    Route::middleware('api.admin')->group(function(){
        // routes to be accessed ONLY by Admins (and SuperAdmins) will go in here

    });

    Route::middleware('auth:api.superAdmin')->group(function(){
        // routes to be accessed by SuperAdmins ONLY will go in here
        Route::post('/updateUser', [\App\Http\Controllers\UsersController::class, 'updateRights']);
        Route::post('/schools', [\App\Http\Controllers\SchoolsController::class, 'store']);
    });

    Route::post('/logout', [Auth\ApiAuthController::class, 'logout'])->name('logout.api');

});
