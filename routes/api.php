<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth:sanctum'])->group(function () {

    //AuthController------------------------------------
    Route::get('logout', [AuthController::class, 'logout']);

    //UserController------------------------------------
    Route::post('getImage', [UserController::class, 'getImage']);
    Route::get('getUserAuthId', [UserController::class, 'getUserAuthId']);
    Route::post('getUserInfo', [UserController::class, 'getUserById']);
    Route::post('getUserFollowers', [UserController::class, 'getUserFollowers']);
    Route::post('getUserFollowed', [UserController::class, 'getUserFollowed']);
    Route::post('update', [UserController::class, 'update']);
    Route::post('updateImage', [UserController::class, 'updateAvatar']);
    Route::post('getFollow', [UserController::class, 'checkFollow']);
    Route::post('search', [UserController::class, 'searchUsers']);


    //PublicationController------------------------------
    Route::get('getFeed', [PublicationController::class, 'index']);
    Route::post('darMg', [PublicationController::class, 'darMg']);
    Route::post('quitarMg', [PublicationController::class, 'quitarMg']);
    Route::post('getUserPublicationsAndImages', [PublicationController::class, 'getPublicationsAndImagesOfUserByUserId']);
    Route::post('getPublicationsAndImageById', [PublicationController::class, 'getPublicationsAndImagesById']);
    Route::post('getLikesOfPublicationById', [PublicationController::class, 'getLikesOfPublicationById']);
    Route::post('getCommentsAndUsersByPublicationId', [PublicationController::class, 'getCommentsAndUsersByPublicationId']);
    Route::post('deletePublication', [PublicationController::class, 'destroy']);
    Route::post('createPublication', [PublicationController::class, 'store']);

    //FollowerController---------------------------------
    Route::post('followUser', [FollowerController::class, 'store']);
    Route::post('unfollowUser', [FollowerController::class, 'destroy']);

    //CommentController----------------------------------
    Route::post('createComment', [CommentController::class, 'store']);

});
