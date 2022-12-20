<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'slug' => $this->faker->unique()->slug(5, 'true'),
            'body' => fake()->paragraph,
            'price_usd' => fake()->randomFloat(0, 10, 50),
            'price_idr' => fake()->randomFloat(0, 100000, 500000),
            'product_type' => $this->faker->randomElement(['free', 'pay']),
            'author_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'category_id' => $this->faker->randomElement(\App\Models\Category::where('type', 'product')->pluck('id')),
            'meta_title' => fake()->name(),
            'meta_description' => fake()->text(100),
        ];
    }

    // products_tags
    public function configure()
    {
        return $this->afterCreating(function ($product) {
            $count_tags = \App\Models\Tag::count();
            $rand_tags = \App\Models\Tag::where('type', 'product')->orderBy(\DB::raw('RAND()'))->take(floor(rand(1, $count_tags) / 2))->get();

            foreach ($rand_tags as $tag) {
                // $product->tags()->attach($tags);
                $product->tags()->sync([$tag->id]);
            }
        });
    }
}
