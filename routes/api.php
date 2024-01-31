<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\SwaggerController;
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

Route::middleware('json')->group(function () {

    Route::get('/generateRootAccount', [AuthentificationController::class, 'root']);

    Route::post('/login', [AuthentificationController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/user', [AuthentificationController::class, 'user']);

        Route::middleware('isadmin')->group(function () {

            Route::post('/register', [AuthentificationController::class, 'register']);
            Route::post('/product/store', [ProductController::class, 'store']);
            Route::put('/product/update/{id}', [ProductController::class, 'update']);
            Route::delete('/product/delete/{id}', [ProductController::class, 'destroy']);

            Route::get('/users', [UserController::class, 'index']);
            Route::get('/user/show/{id}', [UserController::class, 'show']);
            Route::put('/user/update/{id}', [UserController::class, 'update']);
            Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

            Route::get('/production-step-3', [ProductionController::class, 'stepThree']);
            Route::get('/production-step-7', [ProductionController::class, 'stepSeven']);

            Route::get('/swagger-generate', [SwaggerController::class, 'generate']);
        });

        Route::get('/products', [ProductController::class, 'index']);
        Route::get('/product/show/{id}', [ProductController::class, 'show']);

        Route::get('/logout', [AuthentificationController::class, 'logout']);
    });

});