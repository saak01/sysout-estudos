<?php

namespace Database\Seeders;

use App\Models\Optional;
use Illuminate\Database\Seeder;

class OptionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ['name' => 'AR CONDICIONADO'],
            ['name' => 'DIREÇÃO HIDRÁULICA'],
            ['name' => 'VIDRO ELÉTRICO'],
            ['name' => 'BLINDAGEM'],
            ['name' => 'TETO SOLAR'],
            ['name' => 'AIR BAG'],
            ['name' => 'FREIOS ABS'],
            ['name' => 'CÂMBIO MECÂNICO'],
            ['name' => 'CÂMBIO AUTOMÁTICO'],
        ];

        Optional::insert($list);
    }
}
