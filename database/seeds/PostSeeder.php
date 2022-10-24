<?php

use App\Category;
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

    $categoriesId = Category::all()->pluck('id');

    for ($i = 0; $i < 5; $i++) {
      $post = new Post();
      $post->title = $faker->words(rand(5, 10), true);
      $post->content = $faker->paragraphs(rand(1, 5), true);
      $post->slug = str_replace(' ', '-', $post->title);
      $post->category_id = $faker->optional()->randomElement($categoriesId);
      $post->save();
    }
  }
}
