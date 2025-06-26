<?php

namespace App\Models;

use App\Helpers\EnumValueHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Influencer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeActiveInfluencer() {
        return $this->where('status', EnumValueHelper::ACTIVE_INFLUENCER);
    }

    public function influencerReferrals(): HasMany
    {
        return $this->hasMany(InfluencerReferral::class);
    }

    public function fromInfluencerRegistrations(): HasMany
    {
        return $this->hasMany(FromInfluencerRegistration::class);
    }

    public static function baseQuery($search = null) {
        return self::when(!is_null($search), function ($query) use ($search) {
            $query->where('name', 'like', $search . '%');
        });
    }

}
