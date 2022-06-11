<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RoleController;
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
    Route::post('update', [UserController::class, 'update']);
    Route::post('updateById', [UserController::class, 'updateById']);
    Route::post('updateImage', [UserController::class, 'updateAvatar']);
    Route::post('search', [UserController::class, 'searchUsers']);
    Route::get('getAllUsers', [UserController::class, 'getAllUsers']);
    Route::post('deleteUserByUserId', [UserController::class, 'destroy']);
    Route::post('updateImageByUserId', [UserController::class, 'updateAvatarByUserId']);
    Route::post('addNewUser', [UserController::class, 'addNewUser']);


    //PublicationController------------------------------
    Route::get('getFeed', [PublicationController::class, 'index']);
    Route::post('getUserPublicationsAndImages', [PublicationController::class, 'getPublicationsAndImagesOfUserByUserId']);
    Route::post('getPublicationsAndImageById', [PublicationController::class, 'getPublicationsAndImagesById']);
    Route::post('getLikesOfPublicationById', [PublicationController::class, 'getLikesOfPublicationById']);
    Route::post('getCommentsAndUsersByPublicationId', [PublicationController::class, 'getCommentsAndUsersByPublicationId']);
    Route::post('deletePublication', [PublicationController::class, 'destroy']);
    Route::post('createPublication', [PublicationController::class, 'store']);


    //FollowerController---------------------------------
    Route::post('followUser', [FollowerController::class, 'store']);
    Route::post('unfollowUser', [FollowerController::class, 'destroy']);
    Route::post('getUserFollowers', [FollowerController::class, 'getUserFollowers']);
    Route::post('getUserFollowed', [FollowerController::class, 'getUserFollowed']);
    Route::post('getFollow', [FollowerController::class, 'checkFollow']);


    //CommentController----------------------------------
    Route::post('createComment', [CommentController::class, 'store']);


    //LikeController-------------------------------------
    Route::post('darMg', [LikeController::class, 'darMg']);
    Route::post('quitarMg', [LikeController::class, 'quitarMg']);


    //RoleController-------------------------------------
    Route::get('getAuthUserRole', [RoleController::class, 'getAuthUserRole']);
});
