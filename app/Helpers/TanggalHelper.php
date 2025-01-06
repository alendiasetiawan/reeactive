<?php

namespace App\Helpers;

use Carbon\Carbon;

class TanggalHelper
{
    public static function konversiTanggal($tanggal)
    {
        return Carbon::parse($tanggal)
            ->isoFormat('D MMM Y');
    }

    public static function konversiJam($tanggal)
    {
        return Carbon::parse($tanggal)
        ->isoFormat('hh:mm');
    }

    public static function konversiTanggalPenuh($tanggal)
    {
        return Carbon::parse($tanggal)
            ->isoFormat('lll');
    }

    public static function convertImplodeDay($day) {
        $refDays = [
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '6' => 'Sabtu',
            '7' => 'Minggu',
        ];

        $arrayDay = explode(', ', "$day");
        $result = [];
        foreach ($arrayDay as $day) {
            array_push($result, $refDays[$day]);
        }

        return implode(', ', $result);
    }
}
