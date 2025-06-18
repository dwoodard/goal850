<?php

return [
    'publishable_key' => env('STRIPE_KEY'),
    'pricing_table_id' => env('STRIPE_PRICING_TABLE_ID'),
    'plans' => [
        'privacy_credit_monitoring' => env('STRIPE_PLAN_PRIVACY_CREDIT_MONITORING'),
        'full_protection' => env('STRIPE_PLAN_FULL_PROTECTION'),
    ],
];
