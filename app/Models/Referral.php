<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referral extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'referrals';

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_code', 'code');
    }
}
