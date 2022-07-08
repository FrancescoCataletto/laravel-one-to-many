<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0;$i<20;$i++){

            $new_post = new Post;

            $new_post->title = $faker->text();
            $new_post->text = $faker->text();
            $new_post->slug = Str::slug($new_post->title, '-');

            $new_post->save();
        }
    }
}
