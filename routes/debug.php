<?php

use Illuminate\Support\Facades\Route;

// Debugging routes

Route::get('/debug/collection', function () {
    //
})->name('debug');

Route::get('/debug/info', function () {
    return [
        'app' => config('app.name'),
        'environment' => app()->environment(),
        'debug' => config('app.debug'),
    ];
});
