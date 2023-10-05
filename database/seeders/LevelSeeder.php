<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            [
                'level_name' => 'Beginner 1.0',
                'grade' => '1',
            ],
            [
                'level_name' => 'Beginner 2.0',
                'grade' => '2',
            ],
            [
                'level_name' => 'Intermediate',
                'grade' => '3',
            ],
        ]);
    }
}
