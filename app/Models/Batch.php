<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'batch_id', 'id');
    }

    public static function checkRegisteredBatch() {
        return Batch::with('registrations')
        ->where('batch_status', 'Open')
        ->get();
    }

}
