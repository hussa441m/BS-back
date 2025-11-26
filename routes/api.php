<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/projects', ProjectController::class);
    

Route::fallback(function () {
    return apiError("path is incorrect", [
        'url' => URL::current()
    ]);
});
