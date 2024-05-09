<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandModel;
use Database\Factories\BrandModelFactory;
use Illuminate\Database\Seeder;

class BrandModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = Brand::all();

        foreach ($brands as $brand ) {
            BrandModel::factory()->count(10)->create([
                'brand_id' => $brand->id
            ]);
        }
    }
}
