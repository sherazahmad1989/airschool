<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PublicAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    //All the routes that belongs to the group goes here
    Route::get('dashboard', function() {} );
});


Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    //public auth
  //  Route::post('/public-login', [PublicAuthController::class, 'login']);
    Route::get('/create-public-token', [PublicAuthController::class, 'createPublicToken']);
    Route::post('/refresh', [PublicAuthController::class, 'refresh']);
    Route::get('/public-user-profile', [PublicAuthController::class, 'userProfile']);
});


Route::group([
  //  'middleware' => ['auth:api-public'],
    'prefix' => 'public-auth'
], function ($router) {
  //  Route::post('/logout', [PublicAuthController::class, 'logout']);

});
