<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faculty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()

    {
        return [
            'name' => 'Faculty of ' . $this->faker->realText(30,  1),
            'address' => $this->faker->streetAddress . ' ' . $this->faker->city,
            'scientific_field' => $this->faker->realText(40, 4),
            'university_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
