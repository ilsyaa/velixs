<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'slug' => $this->faker->unique()->slug(5, 'true'),
            'body' => fake()->paragraph,
            'author_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'category_id' => $this->faker->randomElement(\App\Models\Category::where('type', 'blog')->pluck('id')),
            'meta_title' => fake()->name(),
            'meta_description' => fake()->text(100),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    // products_tags
    public function configure()
    {
        return $this->afterCreating(function ($blog) {
            $count_tags = \App\Models\Tag::count();
            $rand_tags = \App\Models\Tag::where('type', 'blog')->orderBy(\DB::raw('RAND()'))->take(floor(rand(1, $count_tags) / 2))->get();

            foreach ($rand_tags as $tag) {
                // $product->tags()->attach($tags);
                $blog->tags()->sync([$tag->id]);
            }
        });
    }
}
