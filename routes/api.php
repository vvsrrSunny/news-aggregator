<?php

use App\Http\Controllers\NewsAggregatorController;
use App\Http\Controllers\NewsItemController;
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

Route::get('news', [NewsAggregatorController::class, 'index'])
    ->name('news.index');

Route::get('news/{id}/profile', [NewsItemController::class, 'index'])
    ->where('id', '[\w\-\._\/]+') // Only allow alphanumeric characters, dashes, dots, and percent signs
    ->name('news.profile.index');

Route::get('news/{id}/pin', [NewsItemController::class, 'pin'])
    ->where('id', '[\w\-\._\/]+') // Only allow alphanumeric characters, dashes, dots, and percent signs
    ->name('news.profile.pin');
