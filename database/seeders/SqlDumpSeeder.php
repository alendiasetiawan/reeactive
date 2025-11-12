<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SqlDumpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path ke file SQL
        $paths = [
            'database/seeders/dumps/roles.sql',
            'database/seeders/dumps/countries.sql',
            'database/seeders/dumps/level.sql',
            'database/seeders/dumps/programs.sql',
            'database/seeders/dumps/coach.sql',
            'database/seeders/dumps/class.sql',
            'database/seeders/dumps/pricelist.sql',
            'database/seeders/dumps/certificate.sql',
            'database/seeders/dumps/skils.sql',
            'database/seeders/dumps/class_session.sql',
            'database/seeders/dumps/batches.sql',
        ];

        foreach ($paths as $key => $path) {
            $sql = File::get($path);
            DB::unprepared($sql);
        }

        // $path = "database/seeders/dumps/coach.sql";
        // $sql = File::get($path);
        // DB::unprepared($sql);

        $this->command->info('SQL dump berhasil diimport!');
    }
}
