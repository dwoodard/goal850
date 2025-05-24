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
        'last_privacy_scan',
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
            'last_privacy_scan' => 'datetime',
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
        $hasID = filled($this->stripe_id);

        // how do i know if the user is active or not?

        // list all subscriptions
        $subscriptions = $this->subscriptions;
        $hasAnyActive = $subscriptions->contains(function ($subscription) {
            return $subscription->active();
        });

        return $hasID && $hasAnyActive;
    }

    public function canPrivacyScan(): bool
    {
        // check when the last time privacy scan was run
        $lastScan = $this->last_privacy_scan;

        // return true if the last scan was more than 14 days ago or never run
        return ! $lastScan || $lastScan->diffInDays(now()) > 14;
    }

    public function hasCompletedGhl(): bool
    {
        return filled($this->ghl_contact_id) && filled($this->ghl_location_id);
    }

    public function hasCompletedArrayUser(): bool
    {
        return filled($this->array_user_id);
    }

    public function hasCompletedArrayUserToken(): bool
    {
        return filled($this->array_user_token);
    }

    public function hasCompletedRegistration(): bool
    {
        return $this->hasCompletedGhl() &&
               $this->hasCompletedStripe() &&
               $this->hasCompletedArrayUser() &&
               $this->hasCompletedArrayUserToken();
    }
}
