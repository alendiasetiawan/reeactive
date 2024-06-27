<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    use HasFactory;

    protected $table = 'reset_password';
    protected $guarded = ['id'];

    public static function newestRequest($limitData, $search) {
        return self::when($search != null, function($query) use ($search) {
            return $query->where('member_name', 'like', '%'.$search.'%');
        })
        ->orderBy('id', 'desc')->paginate($limitData);
    }
}
