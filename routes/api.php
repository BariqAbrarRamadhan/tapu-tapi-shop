<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('auth')->group(function () {
//     Route::post('/signin', [AuthController::class, 'SignIn']);
//     Route::post('admin', [AuthController::class, 'auth_login_admin']);
//     Route::get('admin/logout', [AuthController::class, 'logout_admin'])->middleware('auth:sanctum');
// });
    // Route::get('/signout', [AuthController::class, 'SignOut'])

// Route::get('/tokens', function (Request $request) {
//     return $request->user()->tokens;
// })->middleware('auth:sanctum');

// Route::get('/me', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
