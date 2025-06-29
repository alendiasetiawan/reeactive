<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneCode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function baseQuery($search = null) {
        return self::when($search, function ($q, $search) {
            $q->where('country_name', 'like', '%' . $search)
            ->orWhere('code', 'like', '%' . $search . '%')
            ->orWhere('country_name', 'like', $search . '%');
        })
        ->orderBy('country_name', 'asc')
        ->get();
    }
}
