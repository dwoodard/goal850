<?php

return [
    'publishable_key' => env('STRIPE_KEY'),

    // https://dashboard.stripe.com/pricing-tables
    'pricing_table_id' => env('STRIPE_PRICING_TABLE_ID'),

    // https://dashboard.stripe.com/products
    'plans' => [
        'privacy_credit_monitoring' => [
            'product_id' => env('STRIPE_PLAN_PRIVACY_CREDIT_MONITORING'),
            'price_id' => env('STRIPE_PLAN_PRIVACY_CREDIT_MONITORING_PRICE'),
            'name' => 'Privacy Credit Monitoring',
            'array_products' => [
                'exp1bStandardMonitoring', // Credit Alerts
                'ppPIPMonitoringAndRemoval', // PIP Dashboard
            ],
        ],
        'full_protection' => [
            'product_id' => env('STRIPE_PLAN_FULL_PROTECTION'),
            'price_id' => env('STRIPE_PLAN_FULL_PROTECTION_PRICE'),
            'name' => 'Full Protection',
            'array_products' => [
                'exp1bStandardMonitoring', // Credit Alerts
                'idpBundle1Insurance1mmRestoreBundleMonitoring', // Identity Protect
                'idpFinancialThresholdMonitoring', // Identity Protect
                'idpNeighborhoodWatch', // NHW
                'ppPIPMonitoringAndRemoval', // PIP Dashboard
            ],
        ],

    ],
];
