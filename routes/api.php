<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmoteController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('users', UserController::class);
// Route::post('/users', [UserController::class, 'store']);

Route::post('user/login', [UserController::class, 'login']);
Route::get('user/data/{token}', [UserController::class, 'data']);
Route::get('user/patrons/{token}', [UserController::class, 'patrons']);
Route::get('user/patronizes/{token}', [UserController::class, 'patronizes']);
Route::get('get-user-emotes-and-icons/{token}', [EmoteController::class, 'get_user_emotes_and_icons']);
Route::post('send-user-icons', [EmoteController::class, 'send_user_icons']);