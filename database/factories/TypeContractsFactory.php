<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TypeContractsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'type_contract' => $faker->name(),
        ];
    }
}
