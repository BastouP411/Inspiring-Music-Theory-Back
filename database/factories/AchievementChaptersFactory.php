<?php

namespace Database\Factories;

use App\Models\AchievementChapters;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementChaptersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AchievementChapters::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 1,
        ];
    }
}
