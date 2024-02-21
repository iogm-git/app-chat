<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::controller(ChatController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'index')->name('chat');
    Route::post('/', 'store');
    Route::post('/show', 'show');
});
