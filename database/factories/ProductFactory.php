<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-10 days', '-1 day');
        $finish = $this->faker->dateTimeBetween($start, 'now');

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'amount_per_minute' => $this->faker->randomFloat(2, 0.1, 5),
            'started_at' => $start,
            'finished_at' => $finish,
            'active' => true,
        ];
    }
}
