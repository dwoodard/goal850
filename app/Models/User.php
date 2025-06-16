<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

    // plans()
    public function plans()
    {
        return $this->subscriptions()
            ->where('stripe_status', 'active');
    }

    public function stripeProductIds(): array
    {
        return $this->subscriptions()
            ->active()
            ->with('items') // eager-load items
            ->get()
            ->flatMap(function ($subscription) {
                return $subscription->items->pluck('stripe_product');
            })
            ->unique()
            ->filter()
            ->values()
            ->toArray();
    }

    public function refreshArrayToken(): ?string
    {
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'x-array-server-token' => config('array.api_token'),
        ])->post(config('array.api_url').'/api/authenticate/v2/usertoken', [
            'appKey' => config('array.app_key'),
            'userId' => $this->array_user_id,
            'ttlInMinutes' => 60,
        ]);

        $token = $response->json('userToken');

        if ($token) {
            $this->update([
                'array_user_token' => $token,
            ]);
        }

        return $token;
    }

    public function stripeProductsIds(): array
    {
        // when stipe hits this method, we need to get the product id
        $productIds = $this->stripeProductIds();
        if (empty($productIds)) {
            Log::warning("User {$this->id} has no Stripe products", [
                'stripe_products' => $this->stripeProductIds(),
            ]);

            return [];
        }
        $stripePlans = config('stripe.plans', []);

        $arrayProducts = [];

        foreach ($stripePlans as $plan) {
            if (in_array($plan['product_id'], $productIds)) {
                $arrayProducts = array_merge($arrayProducts, $plan['array_products']);
            }
        }

        return array_unique($arrayProducts);
    }

    public function enrollInArrayProducts(): void
    {

        dump(
            $this
        );

        // first we need to get all the products based on the user's subscriptions
        $productIds = $this->stripeProductIds();

        // if the user has no products, we can't enroll them in Array products
        if (empty($productIds)) {
            Log::warning("User {$this->id} has no Stripe products", [
                'stripe_products' => $productIds,
            ]);

            return;
        }

        // Get the stripe plans config
        $stripePlans = config('stripe.plans', []);

        // now that we have the plans we need to get the current stripe plan that the user is subscribed to
        // and get the array_products from it

        $matchedPlans = collect($stripePlans)->filter(function ($plan) use ($productIds) {
            return in_array($plan['product_id'], $productIds ?? []);
        })->first();

        dump([
            'matchedPlans' => $matchedPlans,
            'array_products' => $matchedPlans['array_products'] ?? [],
        ]);

        // now we have a matched plan, we can get the array_products out of it, this is what we need to enroll the user in Array products
        $arrayProducts = $matchedPlans['array_products'] ?? [];

        // Log the enrollment process
        Log::info("User {$this->id} - Enrolling in array products", [
            'stripe_products' => $this->stripeProductIds(),
            'array_products' => $arrayProducts,
        ]);

        foreach ($arrayProducts as $code) {

            Log::info('Posting to Array API', [
                'userId' => $this->array_user_id,
                'enrollmentCode' => $code,
            ]);
            dump(
                "Enrolling user {$this->id} in Array product with code: {$code}"
            );

            Http::withHeaders([
                'accept' => 'application/json',
                'content-type' => 'application/json',
                'x-array-server-token' => config('array.api_token'),
            ])->post(config('array.api_url').'/api/monitoring/v2', [
                'userId' => $this->array_user_id,
                'enrollmentCode' => $code,
            ]);
        }
    }
}
