<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OdersController;
use App\Http\Controllers\KhmerController;
use App\Http\Controllers\ProfileController;

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

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/posts', [PostController::class,'index']); // all post
Route::get('/{category}', [KhmerController::class,'index']); // all post
Route::post('/posts/find', [PostController::class,'search']); //search item
Route::get('/profile/user', [ProfileController::class,'index']);


// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {

    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::put('/user', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Post
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{id}', [PostController::class, 'update']); // update post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post
    Route::post('/posts/profile', [ProfileController::class, 'store']);
    Route::get('/posts/profile/show', [ProfileController::class, 'show']);

    Route::get('/orders/renter', [OdersController::class, 'index']); //seller view order
    Route::get('/orders/customer', [OdersController::class, 'show']); //seller view order
    Route::post('/posts/orders', [OdersController::class, 'store']);
    Route::put('/posts/orders', [OdersController::class, 'update']);
});
