<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('mail', \App\Http\Controllers\MailController::class);
Route::post('upload', \App\Http\Controllers\UploadFileController::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource(
        'tweet',
        \App\Http\Controllers\TweetController::class
    )->except(['create']);

    Route::resource(
        'tweet/{tweet}/comment',
        \App\Http\Controllers\TweetCommentController::class
    )->except(['index', 'create', 'show']);
});
