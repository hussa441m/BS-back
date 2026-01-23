<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactTypeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\ٌRoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::get('/provinces', [SettingController::class, 'provinces']);

Route::get('/project-types', [ProjectTypeController::class, 'index']);
Route::get('/document-types', [DocumentTypeController::class, 'index']);
Route::get('/contact-types', [ContactTypeController::class, 'index']);

Route::get('/roles', [ٌRoleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/documents/{document}/download', [DocumentController::class, 'download']);

    Route::apiResource('/projects', ProjectController::class);

    Route::get('profile', [AuthController::class, 'getProfile']);
    Route::put('profile', [AuthController::class, 'updateProfile']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications',  'index');
        Route::get('/notifications/unread-count',  'unreadCount');
        Route::patch('/notifications/mark-as-read',  'markAsRead');
    });

    Route::get('getClients/{role}', [CustomerController::class, 'getClients']);
    Route::get('getSteps/{project}', [ProjectController::class, 'getSteps']);

    Route::middleware('user-type:admin')->group(function () {
        Route::apiResource('/project-types', ProjectTypeController::class)->except('index');
        Route::apiResource('/document-types', DocumentTypeController::class)->except('index');
        Route::apiResource('/contact-types', ContactTypeController::class)->except('index');
        Route::apiResource('/roles', ٌRoleController::class)->except('index');

        Route::get('/clients', [ProfileController::class, 'index']);
        Route::patch('/clients/{user}', [ProfileController::class, 'accept']);

        Route::get('/totals', [AdminController::class, 'totals']);
    });

    Route::middleware('user-type:client')->prefix('client')->group(function () {

        Route::controller(ClientController::class)->group(function () {
            Route::get('getTotals',  'getTotals');
            Route::get('getNewProjects',  'getNewProjects');
            Route::get('getProjects/{status}',  'getProjects');
            Route::get('isActive',  'isActive');

            Route::post('addOffer/{project}',  'addOffer');
            Route::post('addStep/{project}',  'addStep');
            Route::post('end/{project}',  'endProject');
        });
    });
    Route::middleware('user-type:customer')->prefix('customer')->group(function () {
        Route::controller(ProjectController::class)->group(function () {
            Route::get('getCustomerProjects', 'getCustomerProjects');
        });
        Route::controller(CustomerController::class)->group(function () {
            Route::get('getOffers/{project}', 'getOffers');
            Route::post('acceptOffer/{project}/{offer}', 'acceptOffer');
            Route::post('rate/{project}', 'rate');
        });
    });
});





Route::fallback(function () {
    return apiError("path does not exist !!! 😁", [
        'url' => URL::current()
    ]);
});
