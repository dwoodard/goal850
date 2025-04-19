<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Billable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'phone',
        'email',
        'password',
        'ghl_contact_id',
        'ghl_location_id',
        'array_user_id',
        'array_user_token',
        'last_login',
        'login_count',
        'last_ip',
        'user_agent',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'last_login' => 'datetime',
            'login_count' => 'integer',
            'last_ip' => 'string',
            'user_agent' => 'string',
        ];
    }

    /**
     * Determine if the user is an admin.
     */
    public function getIsAdminAttribute(): bool
    {
        return (bool) $this->super;
    }

    // a check if the user is subscribed
    public function subscribed(): bool
    {
        return $this->subscribed('default');
    }

    public function hasCompletedStripe(): bool
    {
        // check if the user has a stripe id
        if (! filled($this->stripe_id)) {
            Log::debug("User {$this->id}: hasCompletedStripe returning false (no stripe_id).");

            return false;
        }

        try {
            // Use Cashier's built-in check. It verifies if a subscription
            // named 'default' exists and is considered valid (active, trialing, etc.).
            $isSubscribed = $this->findActiveDefaultSubscription() !== null;

            if (! $isSubscribed) {
                Log::debug("User {$this->id}: hasCompletedStripe returning false (subscribed('default') is false).");
                // This is expected if they haven't subscribed or the subscription isn't 'valid'.
            } else {
                Log::debug("User {$this->id}: hasCompletedStripe check passed (subscribed('default') is true).");
            }

            return $isSubscribed;

        } catch (\Throwable $e) {
            // Log any unexpected error during the subscription check
            Log::error("User {$this->id}: Error checking Stripe subscription status in hasCompletedStripe.", [
                'message' => $e->getMessage(),
                'exception' => $e, // Includes stack trace in log context
            ]);

            // Gracefully fail: If we can't check the subscription, assume not completed.
            return false;
        }
    }

    public function hasCompletedGhl(): bool
    {
        return filled($this->ghl_contact_id) && filled($this->ghl_location_id);
    }

    public function hasCompletedArrayUser(): bool
    {
        return filled($this->array_user_id);
    }

    public function hasCompletedArrayAuthentication(): bool
    {
        return filled($this->array_authentication_kba);
    }

    public function hasCompletedRegistration(): bool
    {
        return $this->hasCompletedStripe() &&
               $this->hasCompletedGhl() &&
               $this->hasCompletedArrayUser() &&
               $this->hasCompletedArrayAuthentication();
    }

    /**
     * Helper to get the active default subscription, handling potential errors.
     * Used by the middleware.
     */
    public function findActiveDefaultSubscription(): ?\Laravel\Cashier\Subscription
    {
        try {
            // Note: `active()` checks for stripe_status == 'active'.
            // If you also want to allow 'trialing', you might use
            return $this->subscription('default')?->valid() ? $this->subscription('default') : null;

            // However, usually `active()` is what you want for access control.
            return $this->subscriptions('default')->active()->first();
        } catch (\Throwable $e) {
            Log::error("User {$this->id}: Error querying active default subscription.", [
                'message' => $e->getMessage(),
                'exception' => $e,
            ]);

            return null; // Return null if query fails
        }
    }
}
