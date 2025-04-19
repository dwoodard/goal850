<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationWizardController;
use Core\Authentication\Auth;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => false, // Route::has('register'),
    ]);
})->name('welcome');

Route::middleware(\App\Http\Middleware\CheckUserRegistration::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/registration', [RegistrationWizardController::class, 'index'])->name('registration.wizard');
    Route::post('/registration', [RegistrationWizardController::class, 'store'])
        ->middleware([HandlePrecognitiveRequests::class])
        ->name('registration.wizard.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Billing
    Route::get('/billing', function () {
        return Inertia::render('Billing/Index');
    })->name('billing');
});

// route post stripe/webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

// Route::get('/settings', function () {
//     return Inertia::render('Settings');
// })->middleware('auth')->name('settings');

// Route::get('/notifications', function () {
//     return Inertia::render('Notifications');
// })->middleware('auth')->name('notifications');

require __DIR__.'/auth.php';

// Add a new routes file for debugging purposes
require __DIR__.'/debug.php';
