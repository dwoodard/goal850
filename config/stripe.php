<?php

return [
    'publishable_key' => env('STRIPE_KEY'),

    // Pricing Table Configuration (environment-specific)
    'pricing_table_id' => env('STRIPE_PRICING_TABLE_ID'),
    'pricing_tables' => [
        'default' => env('STRIPE_PRICING_TABLE_ID'),
        'current' => env('STRIPE_PRICING_TABLE_ID'),
    ],

    // Plan Configuration with Product and Price IDs
    'plans' => [
        'privacy_credit_monitoring' => [
            'product_id' => env('STRIPE_PLAN_PRIVACY_CREDIT_MONITORING'),
            'price_id' => env('STRIPE_PLAN_PRIVACY_CREDIT_MONITORING_PRICE'),
            'name' => 'Privacy Credit Monitoring',
            'description' => 'Basic privacy and credit monitoring protection',
        ],
        'full_protection' => [
            'product_id' => env('STRIPE_PLAN_FULL_PROTECTION'),
            'price_id' => env('STRIPE_PLAN_FULL_PROTECTION_PRICE'),
            'name' => 'Full Protection',
            'description' => 'Complete privacy and protection suite',
        ],
    ],
];
