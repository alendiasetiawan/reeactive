<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coachs')->insert([
            [
                'code' => '81284746374',
                'coach_name' => 'Nuritia Septiantry',
                'nick_name' => 'Riri',
                'gender' => 'Perempuan',
                'birth_place' => null,
                'birth_date' => null,
                'marriage_status' => 'Menikah',
                'address' => null,
                'mobile_phone' => '6281284746374',
                'email' => null,
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '81222266771',
                'coach_name' => 'Rachmawati Isnaeni Tjakrawanagiri',
                'nick_name' => 'Ayy',
                'gender' => 'Perempuan',
                'birth_place' => 'Bandung',
                'birth_date' => null,
                'marriage_status' => null,
                'address' => 'Bandung, Jawa Barat, Indonesia',
                'mobile_phone' => '6281222266771',
                'email' => 'isnaenitj@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '8979034958',
                'coach_name' => 'Mala Damayanti',
                'nick_name' => 'Mala',
                'gender' => 'Perempuan',
                'birth_place' => 'Subang',
                'birth_date' => '1992-02-28',
                'marriage_status' => 'Menikah',
                'address' => 'Gang Cendana 1. Rt 6 Rw 6 no 172. Kojan, warung gantung, kalideres. Jakarta Barat.',
                'mobile_phone' => '628979034958',
                'email' => 'damayantimala8@gmail.com',
                'body_height' => 170,
                'body_weight' => 56,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '82127788784',
                'coach_name' => 'Rahayu Nuryaningrum',
                'nick_name' => 'Rahayu',
                'gender' => 'Perempuan',
                'birth_place' => 'Bandung',
                'birth_date' => '1989-01-03',
                'marriage_status' => 'Menikah',
                'address' => '33 Onong Street Cibadak, Astana Anyar, Bandung, Jawa Barat',
                'mobile_phone' => '6282127788784',
                'email' => 'rahayunuryaningrum@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '82120858812',
                'coach_name' => 'Elisa Rosliana',
                'nick_name' => 'Elisa',
                'gender' => 'Perempuan',
                'birth_place' => null,
                'birth_date' => '1991-07-16',
                'marriage_status' => 'Menikah',
                'address' => 'Kp. Rancabali wetan, Jln. K.H. Sa’ban Gg. Raweta 1 No. 09, RT 01/RW 12, Kelurahan Solokpandan, Kecamatan Cianjur, Kabupaten Cianjur',
                'mobile_phone' => '6282120858812',
                'email' => 'elisaroslianazelin@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '85774827925',
                'coach_name' => 'Dina Yuliana',
                'nick_name' => 'Dina',
                'gender' => 'Perempuan',
                'birth_place' => 'Bogor',
                'birth_date' => '1987-06-24',
                'marriage_status' => 'Lajang',
                'address' => 'Jalan siaga raya no. 7, Pejaten Barat, Pasar Minggu, Jakarta Selatan',
                'mobile_phone' => '6285774827925',
                'email' => 'dinayuliana27@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '8999668485',
                'coach_name' => 'Rini Trimulyati',
                'nick_name' => 'Rini',
                'gender' => 'Perempuan',
                'birth_place' => 'Sumedang',
                'birth_date' => '1990-12-27',
                'marriage_status' => 'Lajang',
                'address' => 'Jalan siaga raya no. 7, Pejaten Barat, Pasar Minggu, Jakarta Selatan',
                'mobile_phone' => '6285774827925',
                'email' => 'rinitrimulyati27@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
            [
                'code' => '87825749786',
                'coach_name' => 'Mega Maharani',
                'nick_name' => 'Mega',
                'gender' => 'Perempuan',
                'birth_place' => 'Tangerang',
                'birth_date' => '1987-12-22',
                'marriage_status' => null,
                'address' => 'Jalan Duren Tiga Barat 6 No. 6 RT 010 RW 002, Jakarta Selatan',
                'mobile_phone' => '6287825749786',
                'email' => 'themegamahar@gmail.com',
                'body_height' => null,
                'body_weight' => null,
                'coach_status' => 'Aktif',
            ],
        ]);
    }
}
