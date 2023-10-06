<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes')->insert([
            [
                'coach_code' => '85774827925',
                'start_time' => '08:10:00',
                'end_time' => '09:10:00',
                'day' => 'Senin, Rabu, Jumat',
                'class_status' => 'Open'
            ],
            [
                'coach_code' => '85774827925',
                'start_time' => '05:30:00',
                'end_time' => '06:30:00',
                'day' => 'Selasa, Kamis, Jumat',
                'class_status' => 'Open'
            ],
            [
                'coach_code' => '85774827925',
                'start_time' => '07:00:00',
                'end_time' => '08:00:00',
                'day' => 'Selasa, Kamis, Jumat',
                'class_status' => 'Open'
            ],
            [
                'coach_code' => '85774827925',
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'day' => 'Selasa, Kamis, Jumat',
                'class_status' => 'Open'
            ],
        ]);
    }
}
