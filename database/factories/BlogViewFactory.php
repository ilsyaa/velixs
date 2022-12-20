<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;

class BlogViewFactory extends Factory
{

    public function definition()
    {
        $agent = new Agent();
        return [
            'blog_id' => $this->faker->randomElement(\App\Models\Blog::pluck('id')),
            'url' => $this->faker->url(),
            'user_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'session_id' => fake()->uuid(),
            'ip' => $this->faker->ipv4,
            'browser' => $agent->browser($this->faker->userAgent()),
            'country' => $this->faker->randomElement(['Indonesia', 'Malaysia', 'Singapore', 'Thailand', 'Vietnam', 'Philippines', 'Brunei', 'Cambodia', 'Laos', 'Myanmar']),
            'device' => $agent->device($this->faker->userAgent()),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
