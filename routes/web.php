<?php

use App\Http\Controllers\NewsAggregatorController;
use App\Http\Controllers\NewsItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('news', [NewsAggregatorController::class, 'index'])
    ->name('news.index');

Route::get('news/{id}/profile', [NewsItemController::class, 'index'])
    ->where('id', '[\w\-\._\/]+') // Only allow alphanumeric characters, dashes, dots, and percent signs
    ->name('news.profile.index');

Route::post('news/{id}/profile', [NewsItemController::class, 'post'])
    ->where('id', '[\w\-\._\/]+') // Only allow alphanumeric characters, dashes, dots, and percent signs
    ->name('news.profile.post');
