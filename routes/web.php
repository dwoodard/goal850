<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\CreditAlertsController;
use App\Http\Controllers\CreditDebtAnalysisController;
use App\Http\Controllers\CreditProtectionController;
use App\Http\Controllers\CreditReportController;
use App\Http\Controllers\CreditScoreCoachController;
use App\Http\Controllers\CreditScoreController;
use App\Http\Controllers\CreditScoreDetailsController;
use App\Http\Controllers\CreditScoreInsightsController;
use App\Http\Controllers\CreditScoreSimulatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdentityProtectController;
use App\Http\Controllers\NeighborhoodWatchController;
use App\Http\Controllers\PrivacyScanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationWizardController;
use App\Http\Controllers\StudentLoanNavigatorController;
use App\Http\Controllers\SubscriptionManagerController;
use Core\Authentication\Auth;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('welcome');

Route::get('/dashboard', fn () => redirect()->route('dashboard.overview'))
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/privacy-scan', [PrivacyScanController::class, 'index'])->name('privacy.scan');
});

Route::middleware([
    'auth',
    \App\Http\Middleware\ArrayTokenCheck::class,
])->group(function () {
    Route::get('/dashboard/overview', [DashboardController::class, 'index'])->name('dashboard.overview');

});

Route::middleware([
    'auth',
    \App\Http\Middleware\CheckUserRegistration::class,
    \App\Http\Middleware\ArrayTokenCheck::class,
])->group(function () {
    Route::get('/credit-report', [CreditReportController::class, 'index'])->name('credit.report');
    Route::get('/credit-score-details', [CreditScoreDetailsController::class, 'index'])->name('credit.score.details');
    Route::get('/credit-protection-controller', [CreditProtectionController::class, 'index'])->name('credit.protection');
    Route::get('/credit-debt-analysis', [CreditDebtAnalysisController::class, 'index'])->name('credit.debt.analysis');
    Route::get('/credit-score-insights', [CreditScoreInsightsController::class, 'index'])->name('credit.score.insights');
    Route::get('/credit-score-simulator', [CreditScoreSimulatorController::class, 'index'])->name('credit.score.simulator');
    Route::get('/credit-score-coach', [CreditScoreCoachController::class, 'index'])->name('credit.score.coach');
    Route::get('/credit-score', [CreditScoreController::class, 'index'])->name('credit.score');
    Route::get('/credit-alerts', [CreditAlertsController::class, 'index'])->name('credit.alerts');
    Route::get('/identity-protect', [IdentityProtectController::class, 'index'])->name('identity.protect');
    Route::get('/neighborhood-watch', [NeighborhoodWatchController::class, 'index'])->name('neighborhood.watch');
    Route::get('/subscription-manager', [SubscriptionManagerController::class, 'index'])->name('subscription.manager');
    Route::get('/student-loan-navigator', [StudentLoanNavigatorController::class, 'index'])->name('student.loan.navigator');
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

    // User
    Route::get('/user', function () {
        return Inertia::render('User/Index');
    })->name('user.index');
});

// route post stripe/webhook
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

// Route::get('/settings', function () {
//     return Inertia::render('Settings');
// })->middleware('auth')->name('settings');

// Route::get('/notifications', function () {
//     return Inertia::render('Notifications');
// })->middleware('auth')->name('notifications');

Route::resource('podcasts', \App\Http\Controllers\PodcastController::class);
Route::get('/podcasts/latest', [\App\Http\Controllers\PodcastController::class, 'latest'])->name('podcasts.latest');

// resources/faq
Route::prefix('resources')->group(function () {
    Route::get('/faq', function () {
        return Inertia::render('Faq/Index');
    })->name('faq.index');
});

// education
Route::prefix('education')->group(function () {
    // tutorials
    Route::get('/tutorials', function () {
        return Inertia::render('Education/Tutorials');
    })->name('education.tutorials');
    // webinars
    Route::get('/webinars', function () {
        return Inertia::render('Education/Webinars');
    })->name('education.webinars');

});

Route::get('/privacy', \App\Http\Controllers\PrivacyController::class)->name('privacy');
Route::get('/terms', \App\Http\Controllers\TermsController::class)->name('terms');

// API routes (fix this)
Route::resource('api/user', UserController::class);

require __DIR__.'/auth.php';

// Add a new routes file for debugging purposes
require __DIR__.'/debug.php';
