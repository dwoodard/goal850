<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('collections')->insert(
            [
                [
                    'id' => 1,
                    'handle' => 'pages',
                    'title' => 'pages',
                    'settings' => '{"dated": false, "mount": null, "sites": ["default"], "slugs": true, "inject": [], "layout": "layout", "routes": "{parent_uri}/{slug}", "sort_dir": "asc", "template": "default", "propagate": false, "revisions": false, "structure": {"root": false, "slugs": true}, "sort_field": null, "taxonomies": [], "search_index": null, "title_formats": [], "default_status": true, "origin_behavior": "select", "preview_targets": [{"id": "6BGa1jde", "label": "Entry", "format": "{permalink}", "refresh": true}], "past_date_behavior": "public", "future_date_behavior": "private"}',
                    'created_at' => null,
                    'updated_at' => '2025-01-12 19:14:33',
                ],
                [
                    'id' => 2,
                    'handle' => 'posts',
                    'title' => 'blog',
                    'settings' => '{"dated": true, "mount": null, "sites": ["default"], "slugs": true, "inject": [], "layout": "layout", "routes": "blog/{slug}", "sort_dir": "desc", "template": "default", "propagate": false, "revisions": false, "structure": {"root": false, "slugs": true}, "sort_field": null, "taxonomies": [], "search_index": null, "title_formats": [], "default_status": true, "origin_behavior": "select", "preview_targets": [{"id": "VIQkvhSJ", "label": "Entry", "format": "{permalink}", "refresh": true}], "past_date_behavior": "public", "future_date_behavior": "private"}',
                    'created_at' => null,
                    'updated_at' => '2025-01-12 22:39:36',
                ],
            ]

        );
    }
}
