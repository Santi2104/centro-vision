<?php

namespace Database\Factories;

use App\Models\PracticeGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class PracticeGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PracticeGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cod' => $this->faker->sentence(),
            'description' => $this->faker->sentence()
        ];
    }
}
