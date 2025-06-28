<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/{any}', function () {
//     return file_get_contents(public_path('browser/index.html'));
// })->where('any', '^(?!api).*$');


// Route::prefix('api/v1')->group(function () {
//     Route::get('/profile/{id}', [ProfileController::class, 'show']);
//     Route::post('/profile/{id}', [ProfileController::class, 'update']);
//     Route::post('/generate-profiles', [ProfileController::class, 'generateMultiple']);
// });