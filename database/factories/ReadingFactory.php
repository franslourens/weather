<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Reading;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reading>
 */
class ReadingFactory extends Factory
{
    protected $model = Reading::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'type' => $name,
            'endpoint' => fake()->sentence(),
            'token' => Str::random(10),
            'description' => fake()->paragraph(),
            'slug' => Str::slug($name),
        ];
    }
}
