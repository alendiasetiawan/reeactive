<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'superadmin',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'full_name'  => 'Super Admin',
            'gender' => 'Perempuan',
            'default_pw' => true,
            'type' => 'Reguler'
        ]);
    }
}
