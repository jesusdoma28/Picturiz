<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
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

Route::post('register', [UserController::class, 'store']);

Route::get('publications', [PublicationController::class, 'index']);

//Route::get('publications/user/{id}', [PublicationController::class, 'userPublications']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('getFeed', [PublicationController::class, 'index']);
    Route::post('darMg', [PublicationController::class, 'darMg']);
    Route::post('quitarMg', [PublicationController::class, 'quitarMg']);
    Route::post('getImage', [UserController::class, 'getImage']);
    Route::get('getUserAuthId', [UserController::class, 'getUserAuthId']);
    Route::post('getUserInfo', [UserController::class, 'getUserById']);
    Route::post('getUserPublicationsAndImages', [PublicationController::class, 'getPublicationsAndImagesOfUserByUserId']);
    Route::post('getPublicationsAndImageById', [PublicationController::class, 'getPublicationsAndImagesById']);
    Route::post('getUserFollowers', [UserController::class, 'getUserFollowers']);
    Route::post('getUserFollowed', [UserController::class, 'getUserFollowed']);
    Route::post('getLikesOfPublicationById', [PublicationController::class, 'getLikesOfPublicationById']);
    Route::post('getCommentsAndUsersByPublicationId', [PublicationController::class, 'getCommentsAndUsersByPublicationId']);
    Route::post('update', [UserController::class, 'update']);

});
