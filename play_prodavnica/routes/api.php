<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationReviewController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/applications',[ApplicationController::class, 'index']);

Route::get('/applications/{id}',[ApplicationController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/applications/{id}/reviews', [ApplicationReviewController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/applications',[ApplicationController::class, 'store']);
    
    Route::delete('/applications/{id}',[ApplicationController::class, 'destroy']);
    
    Route::put('/applications/{id}',[ApplicationController::class, 'update']);

    Route::resource('reviews',ReviewController::class)->only(['store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
