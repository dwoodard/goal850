<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('collections')->insert([
            'id' => 1,
            'handle' => 'pages',
            'title' => 'pages',
            'settings' => json_encode([
                'dated' => false,
                'mount' => null,
                'sites' => ['default'],
                'slugs' => true,
                'inject' => [],
                'layout' => 'layout',
                'routes' => '{parent_uri}/{slug}',
                'sort_dir' => 'asc',
                'template' => 'default',
                'propagate' => false,
                'revisions' => false,
                'structure' => ['root' => true, 'slugs' => true],
                'sort_field' => null,
                'taxonomies' => null,
                'search_index' => null,
                'title_formats' => [],
                'default_status' => true,
                'origin_behavior' => 'select',
                'preview_targets' => [['label' => 'Entry', 'format' => '{permalink}', 'refresh' => true]],
                'past_date_behavior' => 'public',
                'future_date_behavior' => 'private',
            ]),
            'created_at' => '2025-01-12 00:14:50',
            'updated_at' => '2025-01-12 00:14:50',
        ]);
    }
}
