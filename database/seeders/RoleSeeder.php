<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Admin',
                'access_grant' => 'Full Control',
            ],
            [
                'role_name' => 'Coach',
                'access_grant' => 'Training Management',
            ],
            [
                'role_name' => 'Member',
                'access_grant' => 'Learn and Train',
            ],
            [
                'role_name' => 'Finance',
                'access_grant' => 'Cash Control',
            ],
            [
                'role_name' => 'Trainer',
                'access_grant' => 'Workshop Training',
            ],
        ]);
    }
}
