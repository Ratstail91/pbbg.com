<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'url' => $this->faker->unique()->url,
            'short_description' => $this->faker->text($maxNbChars = 140),
            'long_description' => $this->faker->text(),
            'image_path' => $this->faker->imageUrl($width = 125, $height = 125),
            'approved' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'verified' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'promoted' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}
