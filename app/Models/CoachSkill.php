<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoachSkill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class, 'coach_code', 'code');
    }

    public function pricelist(): BelongsTo
    {
        return $this->belongsTo(Pricelist::class, 'coach_code', 'coach_code');
    }

}
