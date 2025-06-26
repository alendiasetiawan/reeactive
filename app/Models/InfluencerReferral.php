<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfluencerReferral extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(Influencer::class);
    }

    public function fromInfluencerRegistrations(): HasMany
    {
        return $this->hasMany(FromInfluencerRegistration::class);
    }
}
