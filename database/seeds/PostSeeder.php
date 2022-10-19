<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for($i=0; $i<50; $i++){
        $post= new Post();
        $post->title=$faker->words(rand(5,10), true);
        $post->content=$faker->paragraphs(rand(10,20), true);
        $post->slug = str_replace(' ','-', $post->title);
        $post->save();
      }
    }
}
