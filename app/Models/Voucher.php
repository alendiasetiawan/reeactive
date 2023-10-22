<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function workshop_registrations(): HasMany
    {
        return $this->hasMany(WorkshopRegistration::class, 'voucher_code', 'code');
    }

    public static function voucherUsed($workshopBatchId) {
        return Voucher::with([
            'workshop_registrations' => function($query) use($workshopBatchId) {
                $query->where('workshop_batch_id', $workshopBatchId);
            }
        ])
        ->get();
    }
}
