<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'program_name' => 'Private 1 on 1',
                'quota_min' => 1,
                'quota_max' => 1,
            ],
            [
                'program_name' => 'Buddy',
                'quota_min' => 1,
                'quota_max' => 2,
            ],
            [
                'program_name' => 'Small Group',
                'quota_min' => 4,
                'quota_max' => 6,
            ],
            [
                'program_name' => 'Special Case Group',
                'quota_min' => 10,
                'quota_max' => 15,
            ],
            [
                'program_name' => 'Large Group',
                'quota_min' => 10,
                'quota_max' => 15,
            ],
            [
                'program_name' => 'Nutritionist Consultation',
                'quota_min' => 1,
                'quota_max' => 100,
            ],
        ]);
    }
}
