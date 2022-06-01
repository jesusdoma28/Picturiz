<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Models\Publication;
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

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::get('users', [PublicationController::class, 'index']);



Route::get('publications', [PublicationController::class, 'index']);

//Route::get('publications/user/{id}', [PublicationController::class, 'userPublications']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('publications', [PublicationController::class, 'index']);
    Route::post('darMg', [PublicationController::class, 'darMg']);
    Route::post('quitarMg', [PublicationController::class, 'quitarMg']);
    //Route::post('getFeed', [PublicationController::class, 'index']);
});
