<?php

use App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Api\V1\Admin\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [Admin\AuthController::class, 'login']);

Route::prefix('/admin')->middleware(['auth:sanctum'])->group(function(){



    Route::get('role', [RoleController::class, 'index']);

    Route::post('role', [RoleController::class, 'store'])->middleware('permission:role.create');

    Route::get('role/{role}', [RoleController::class, 'show']);
    Route::put('role/{role}', [RoleController::class, 'update']);
    Route::delete('role/{role}', [RoleController::class, 'destroy']);

});
