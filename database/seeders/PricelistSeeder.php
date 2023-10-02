<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PricelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pricelists')->insert([
            [
                'program_id' => 1,
                'coach_code' => '81284746374',
                'price' => 3500000,
                'price_per_person' => 3500000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '87825749786',
                'price' => 3500000,
                'price_per_person' => 3500000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '8999668485',
                'price' => 3000000,
                'price_per_person' => 3000000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '85774827925',
                'price' => 3000000,
                'price_per_person' => 3000000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '8979034958',
                'price' => 3000000,
                'price_per_person' => 3000000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '82120858812',
                'price' => 3000000,
                'price_per_person' => 3000000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '81222266771',
                'price' => 2700000,
                'price_per_person' => 2700000,
            ],
            [
                'program_id' => 1,
                'coach_code' => '82127788784',
                'price' => 2300000,
                'price_per_person' => 2300000,
            ],
            [
                'program_id' => 2,
                'coach_code' => '8999668485',
                'price' => 4000000,
                'price_per_person' => 2000000,
            ],
            [
                'program_id' => 2,
                'coach_code' => '85774827925',
                'price' => 4000000,
                'price_per_person' => 2000000,
            ],
            [
                'program_id' => 2,
                'coach_code' => '8979034958',
                'price' => 4000000,
                'price_per_person' => 2000000,
            ],
            [
                'program_id' => 2,
                'coach_code' => '82127788784',
                'price' => 3000000,
                'price_per_person' => 1500000,
            ],
            [
                'program_id' => 3,
                'coach_code' => '8999668485',
                'price' => 6000000,
                'price_per_person' => 1500000,
            ],
            [
                'program_id' => 3,
                'coach_code' => '85774827925',
                'price' => 6000000,
                'price_per_person' => 1500000,
            ],
            [
                'program_id' => 3,
                'coach_code' => '8979034958',
                'price' => 6000000,
                'price_per_person' => 1500000,
            ],
            [
                'program_id' => 3,
                'coach_code' => '82127788784',
                'price' => 5000000,
                'price_per_person' => 1250000,
            ],
            [
                'program_id' => 4,
                'coach_code' => '87825749786',
                'price' => 1950000,
                'price_per_person' => 1950000,
            ],
            [
                'program_id' => 4,
                'coach_code' => '8999668485',
                'price' => 1950000,
                'price_per_person' => 1950000,
            ],
            [
                'program_id' => 4,
                'coach_code' => '85774827925',
                'price' => 1950000,
                'price_per_person' => 1950000,
            ],
            [
                'program_id' => 4,
                'coach_code' => '8979034958',
                'price' => 1950000,
                'price_per_person' => 1950000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '81284746374',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '81222266771',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '8979034958',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '82127788784',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '82120858812',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '85774827925',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '8999668485',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
            [
                'program_id' => 5,
                'coach_code' => '87825749786',
                'price' => 1350000,
                'price_per_person' => 1350000,
            ],
        ]);
    }
}
