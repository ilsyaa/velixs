<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageView>
 */
class PageViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $agent = new Agent();
        return [
            'page_index' => $this->faker->randomElement(['master', 1]),
            'url' => 'htttp://localhost:8000',
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
