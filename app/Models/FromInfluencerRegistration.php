<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FromInfluencerRegistration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(Influencer::class);
    }

    public function influencerReferral(): BelongsTo
    {
        return $this->belongsTo(InfluencerReferral::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
