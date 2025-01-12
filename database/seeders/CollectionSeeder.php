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
                    'settings' => '{"dated": false, "mount": null, "sites": ["default"], "slugs": true, "inject": [], "layout": "layout", "routes": "{parent_uri}/{slug}", "sort_dir": "asc", "template": "default", "propagate": false, "revisions": false, "structure": {"root": true, "slugs": true}, "sort_field": null, "taxonomies": null, "search_index": null, "title_formats": [], "default_status": true, "origin_behavior": "select", "preview_targets": [{"label": "Entry", "format": "{permalink}", "refresh": true}], "past_date_behavior": "public", "future_date_behavior": "private"}',
                ],
                [
                    'id' => 2,
                    'handle' => 'posts',
                    'title' => 'posts',
                    'settings' => '{"dated": true, "mount": null, "sites": ["default"], "slugs": true, "inject": [], "layout": "layout", "routes": "blog/{slug}", "sort_dir": "desc", "template": "posts/show", "propagate": false, "revisions": false, "structure": {"root": true, "slugs": true}, "sort_field": null, "taxonomies": [], "search_index": null, "title_formats": [], "default_status": true, "origin_behavior": "select", "preview_targets": [{"id": "VIQkvhSJ", "label": "Entry", "format": "{permalink}", "refresh": true}], "past_date_behavior": "public", "future_date_behavior": "private"}',
                ],
            ]

        );
    }
}
