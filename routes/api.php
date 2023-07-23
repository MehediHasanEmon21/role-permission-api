<?php

use App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Api\V1\Admin\PermissionController;
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

Route::prefix('/admin')->middleware(['auth:sanctum'])->group(function () {

    Route::get('role', [RoleController::class, 'index'])->middleware('permission:role.view');
    Route::post('role', [RoleController::class, 'store'])->middleware('permission:role.create');
    Route::get('role/{id}', [RoleController::class, 'show'])->middleware('permission:role.view');
    Route::put('role/{id}', [RoleController::class, 'update'])->middleware('permission:role.edit');
    Route::delete('role/{id}', [RoleController::class, 'destroy'])->middleware('permission:role.delete');

    Route::get('permission', [PermissionController::class, 'index'])->middleware('permission:permission.view');
    Route::post('permission', [PermissionController::class, 'store'])->middleware('permission:permission.create');
    Route::get('permission/{id}', [PermissionController::class, 'show'])->middleware('permission:permission.view');
    Route::put('permission/{id}', [PermissionController::class, 'update'])->middleware('permission:permission.edit');
    Route::delete('permission/{id}', [PermissionController::class, 'destroy'])->middleware('permission:permission.delete');

});
