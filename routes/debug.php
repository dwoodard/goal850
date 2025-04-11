<?php

use Illuminate\Support\Facades\Route;

if (app()->environment('local')) {
    Route::get('/debug/info', function () {
        return [
            'app' => config('app.name'),
            'environment' => app()->environment(),
            'debug' => config('app.debug'),
        ];
    });
}
