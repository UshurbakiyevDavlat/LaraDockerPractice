<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Claim;
use App\Models\Info;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
         User::factory(100)->create();
         $cat = Category::factory(10)->create();
         $tags = Tag::factory(10)->create();
         Claim::factory(4)->create();
         Info::factory(4)->create();
         $posts = Post::factory(20)->create();

         foreach ($posts as $post) {
             $tag_ids = $tags->random(2)->pluck('id');
             $post->tags()->attach($tag_ids);
         }

    }
}
