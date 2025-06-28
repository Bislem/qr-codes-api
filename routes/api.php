<?php

use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('v1')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::post('/profile/{id}', [ProfileController::class, 'update']);
    Route::post('/generate-profiles', [ProfileController::class, 'generateMultiple']);
    Route::post('/checkPassword/{id}', [ProfileController::class, 'checkPassword']);
    //file upload api
    Route::post('/upload', [UploadController::class, 'upload']);
});
