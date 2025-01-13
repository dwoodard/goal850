<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entries')->insert([

            [
                'id' => 'c5932048-92a6-4287-a3e3-4734d381fd75',
                'site' => 'default',
                'origin_id' => null,
                'published' => 1,
                'slug' => 'post-title-1',
                'uri' => '/blog/post-title-1',
                'date' => '2025-01-12 00:00:00',
                'order' => 1,
                'collection' => 'posts',
                'blueprint' => 'post',
                'data' => '{"title": "post title 1", "parent": null, "content": "post content", "updated_by": 1}',
                'created_at' => '2025-01-12 19:34:56',
                'updated_at' => '2025-01-12 22:44:45',
            ],
            [
                'id' => 'd62cb873-3c8d-426b-bede-f52598611fce',
                'site' => 'default',
                'origin_id' => null,
                'published' => 1,
                'slug' => 'post-title-2',
                'uri' => '/blog/post-title-2',
                'date' => '2025-01-12 00:00:00',
                'order' => 2,
                'collection' => 'posts',
                'blueprint' => 'post',
                'data' => '{"title": "post title 2", "content": "post content 2", "updated_by": 1}',
                'created_at' => '2025-01-12 22:40:27',
                'updated_at' => '2025-01-12 22:44:45',
            ],
            [
                'id' => '0e8c5e42-efbe-40d6-97c7-02e8731cfb2e',
                'site' => 'default',
                'origin_id' => null,
                'published' => 1,
                'slug' => 'home',
                'uri' => '/home',
                'date' => null,
                'order' => 1,
                'collection' => 'pages',
                'blueprint' => 'page',
                'data' => '{"title": "home", "parent": null, "content": "home entry", "updated_by": 1}',
                'created_at' => '2025-01-12 23:17:27',
                'updated_at' => '2025-01-12 23:17:27',
            ],
            [
                'id' => '169a84e6-decc-4d18-adae-bd64de49dd81',
                'site' => 'default',
                'origin_id' => null,
                'published' => 1,
                'slug' => 'about',
                'uri' => '/about',
                'date' => null,
                'order' => 1,
                'collection' => 'pages',
                'blueprint' => 'page',
                'data' => '{"title": "about", "parent": null, "content": "about entry", "updated_by": 1}',
                'created_at' => '2025-01-12 23:19:55',
                'updated_at' => '2025-01-12 23:19:55',
            ],

        ]);
    }
}
