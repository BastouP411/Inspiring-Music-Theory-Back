<?php

namespace Database\Factories;

use App\Models\AchievementMGQ;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementMGQFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AchievementMGQ::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'level' => rand(1, 6),
            'score' => rand(0, 100)/100,
            'evaluated' => rand(0, 1),
        ];
    }
}
