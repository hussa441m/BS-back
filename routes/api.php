<?php

use App\Http\Controllers\Admin\AccountStatusController;
use App\Http\Controllers\Admin\ContactTypeController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\ٌRoleController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/projects', ProjectController::class);

Route::apiResource('/project-types', ProjectTypeController::class );
Route::apiResource('/document-types', DocumentTypeController::class  );
Route::apiResource('/contact-types', ContactTypeController::class  );
Route::apiResource('/roles', ٌRoleController::class  );
    

Route::fallback(function () {
    return apiError("path is incorrect", [
        'url' => URL::current()
    ]);
});
