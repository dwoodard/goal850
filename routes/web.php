<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Core\Authentication\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => false, // Route::has('register'),
    ]);
})
    ->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/subscription-checkout', function (Request $request) {
    return $request->user()
        ->newSubscription('default', 'price_basic_monthly')
        ->trialDays(5)
        ->allowPromotionCodes()
        ->checkout([
            'success_url' => route('subscription-success'),
            'cancel_url' => route('subscription-cancel'),
        ]);
});

// register success subscription route
Route::get('/subscription-success', function (Request $request) {
    return 'Subscription was successful';
})->name('subscription-success');

// register cancel subscription route
Route::get('/subscription-cancel', function (Request $request) {
    return 'Subscription was cancelled';
})->name('subscription-cancel');

Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal(route('dashboard'));
});

// Route::get('/settings', function () {
//     return Inertia::render('Settings');
// })->middleware('auth')->name('settings');

// Route::get('/notifications', function () {
//     return Inertia::render('Notifications');
// })->middleware('auth')->name('notifications');

require __DIR__.'/auth.php';
