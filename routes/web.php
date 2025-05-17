<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrivacyScanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationWizardController;
use Core\Authentication\Auth;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/privacy-scan', [PrivacyScanController::class, 'index'])->name('privacy.scan');
});

Route::middleware([
    \App\Http\Middleware\CheckUserRegistration::class,
    \App\Http\Middleware\ArrayTokenCheck::class,
])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('dashboard'))->name('dashboard');
    Route::get('/dashboard/overview', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/registration/user', [RegistrationWizardController::class, 'user'])->name('registration.wizard.user');
    Route::get('/registration/kba', [RegistrationWizardController::class, 'kba'])->name('registration.wizard.kba');

    Route::post('/registration/user/store', [RegistrationWizardController::class, 'userStore'])
        ->middleware([HandlePrecognitiveRequests::class])
        ->name('registration.wizard.user.store');

    Route::post('/registration/kba/store', [RegistrationWizardController::class, 'kbaStore'])
        ->name('registration.wizard.kba.store');

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
