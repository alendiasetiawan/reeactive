<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassDate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function specialRegistration(): BelongsTo
    {
        return $this->belongsTo(SpecialRegistration::class, 'special_registration_id', 'id');
    }
}
