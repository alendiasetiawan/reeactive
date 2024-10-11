<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherMerchandise extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_code', 'code');
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id', 'id');
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
    }

    public static function generateVoucherMerchandise($batchId, $memberCode, $validDate, $registerId) {
        return VoucherMerchandise::updateOrCreate([
            'batch_id' => $batchId,
            'member_code' => $memberCode
        ], [
            'qr_code' => time(),
            'registration_id' => $registerId,
            'valid_date' => $validDate,
            'is_used' => 0,
        ]);
    }
}
