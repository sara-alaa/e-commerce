<?php

use App\Http\Controllers\Api\Store\StoreController;
use App\Http\Controllers\Api\User\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

Route::post('register', [RegisterController::class, 'register']);
Route::group(['middleware' => ['auth:api', 'verified']], function () {
    Route::post('store', [StoreController::class, 'store']);
    Route::get('store/{store}', [StoreController::class, 'show']);
    Route::put('store/{store}', [StoreController::class, 'update']);
});
