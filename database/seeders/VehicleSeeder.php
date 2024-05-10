<?php

namespace Database\Seeders;

use App\Models\BrandModel;
use App\Models\Color;
use App\Models\Optional;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Vehicle Seeder.
     *
     * @return void
     */
    public function run()
    {
        $models = BrandModel::all();

        $colors = Color::all();

        $optionals = Optional::all();


        foreach ($models as $index => $model) {

            $randomColor = $colors->random();


            $randomOptionalsN = random_int(0, $optionals->count());

            //Mudar qtd de opcionais aleatorios
            $randomOptionals = $optionals->random($randomOptionalsN);

            $randomOpitionalsIds = $randomOptionals->pluck('id')->toArray();

            $plate = 'ABC'.str_pad($index,4,'0',STR_PAD_LEFT);

            $vehicle = Vehicle::factory()->create(
                [
                    'model_id' => $model->id,
                    'color_id' => $randomColor->id,
                    'plate' => $plate
                ]);

            $vehicle->optionals()->sync($randomOpitionalsIds);
        }
    }
}
