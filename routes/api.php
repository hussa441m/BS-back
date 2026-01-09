<?php

use App\Http\Controllers\Admin\ContactTypeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\ٌRoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/project-types', [ProjectTypeController::class, 'index']);
Route::get('/document-types', [DocumentTypeController::class, 'index']);
Route::get('/contact-types', [ContactTypeController::class, 'index']);
Route::get('/account-statuses', [ٌRoleController::class, 'index']);

Route::get('/roles', [ٌRoleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('user-type:admin')->group(function () {
        Route::apiResource('/project-types', ProjectTypeController::class)->except('index');
        Route::apiResource('/document-types', DocumentTypeController::class)->except('index');
        Route::apiResource('/contact-types', ContactTypeController::class)->except('index');
        Route::apiResource('/roles', ٌRoleController::class)->except('index');

        Route::get('/clients', [ProfileController::class, 'index']);
        Route::patch('/clients/{user}', [ProfileController::class, 'accept']);
    });
    
    Route::apiResource('/projects', ProjectController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});


Route::middleware(['auth:sanctum', 'user-type:client'])->prefix('client')->group(function () {
    Route::get('/notifications', [NotificationController::class , 'index']);
    Route::get('/notifications/unread-count', [NotificationController::class , 'unreadCount']);
    Route::patch('/notifications/mark-as-read', [NotificationController::class , 'markAsRead']);
});



Route::fallback(function () {
    return apiError("path does not exist !!! 😁", [
        'url' => URL::current()
    ]);
});
