<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $f = $this->faker;

        $f->addProvider(new \Faker\Provider\ms_MY\Miscellaneous($f));

        $modelYear = $f->numberBetween(1990,date('Y'));
        $year = $f -> boolean ? $modelYear : $modelYear + 1;

        return [
            'model_id' => null,
            'model_year' => $modelYear,
            'year' => $year,
            'color_id' => null,
            'plate' => null,
        ];
    }
}
