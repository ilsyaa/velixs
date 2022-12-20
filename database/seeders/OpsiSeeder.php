<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create(
        //     [
        //         'name' => 'Ilsya',
        //         'username' => 'user',
        //         'email' => 'user@gmail.com',
        //         'role' => 'user',
        //         'password' => bcrypt('password'),
        //         'email_verified_at' => now(),
        //     ]
        // );
        // \App\Models\User::factory(5)->create();
        // custom create category
        \DB::table('categories')->insert([
            [
                'title' => 'HTML',
                'slug' => 'html',
                'type' => 'blog',
            ],
            [
                'title' => 'PHP',
                'slug' => 'php',
                'type' => 'blog',
            ],
            [
                'title' => 'Laravel',
                'slug' => 'laravel',
                'type' => 'blog',
            ],
            [
                'title' => 'Bootstrap',
                'slug' => 'bootstrap',
                'type' => 'blog',
            ],
            [
                'title' => 'JavaScript',
                'slug' => 'js',
                'type' => 'blog',
            ],

            // [
            //     'title' => 'Hiburan',
            //     'slug' => 'hiburan',
            //     'type' => 'blog',
            // ],
            // [
            //     'title' => 'PHP Script',
            //     'slug' => 'php-script',
            //     'type' => 'product',
            // ],
            // [
            //     'title' => 'HTML Template',
            //     'slug' => 'html-template',
            //     'type' => 'product',
            // ],
            // [
            //     'title' => 'Node Js',
            //     'slug' => 'nodejs',
            //     'type' => 'product',
            // ],
            // [
            //     'title' => 'JavaScript',
            //     'slug' => 'js',
            //     'type' => 'product',
            // ]
        ]);
        // \DB::table('tags')->insert([
        //     [
        //         'name' => 'Tutorial Dasar',
        //         'slug' => 'dasar',
        //         'type' => 'blog',
        //     ],
        //     [
        //         'name' => 'Laravel',
        //         'slug' => 'laravel',
        //         'type' => 'product',
        //     ],
        //     [
        //         'name' => 'CodeIngiter',
        //         'slug' => 'codeigniter',
        //         'type' => 'product',
        //     ],
        //     [
        //         'name' => 'Bootstrap',
        //         'slug' => 'bootstrap',
        //         'type' => 'product',
        //     ],
        //     [
        //         'name' => 'VueJs',
        //         'slug' => 'vue',
        //         'type' => 'product',
        //     ],
        // ]);
        // \DB::table('pages')->insert([
        //     [
        //         'title' => 'test page',
        //         'slug' => 'test-page',
        //         'body' => 'ini content',
        //         'author_id' =>  1,
        //         'meta_title' => 'test page',
        //         'meta_description' => 'test page',
        //         'meta_keywords' => 'test,keyboards',
        //         'meta_robots' => 'index, follow',
        //         'published_at' => now(),
        //     ]
        // ]);

        // factory product
        // \App\Models\Product::factory(20)->create();
        // \App\Models\ProductLibrary::factory(2)->create();
        // \App\Models\ProductViews::factory(200)->create();
        // \App\Models\Blog::factory(200)->create();
        // \App\Models\BlogView::factory(200)->create();
        // \App\Models\PageView::factory(200)->create();
    }
}
