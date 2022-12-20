<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductLibrary>
 */
class ProductLibraryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomElement(\App\Models\Product::where('product_type', 'pay')->pluck('id')),
            'user_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'license' => $this->generate_license('METAVIS'),
        ];
    }

    public function generate_license($prefix)
    {
        $num_segments = 3;
        $segment_chars = 5;
        $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $license_string = '';
        // Build Default License String
        for ($i = 0; $i < $num_segments; $i++) {
            $segment = '';
            for ($j = 0; $j < $segment_chars; $j++) {
                $segment .= $tokens[rand(0, strlen($tokens) - 1)];
            }
            $license_string .= $segment;
            if ($i < ($num_segments - 1)) {
                $license_string .= '-';
            }
        }
        return "$prefix-$license_string";
    }
}
