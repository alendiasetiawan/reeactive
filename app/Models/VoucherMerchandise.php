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

    public static function latestVoucher($memberCode, $batchId) {
        return VoucherMerchandise::where('member_code', $memberCode)
        ->where('batch_id', $batchId)
        ->latest()
        ->firstOrFail();
    }

    public static function getOneVoucher($code) {
        return VoucherMerchandise::with([
            'registration' => function ($query) {
                $query->join('programs', 'registrations.program_id', 'programs.id')
                ->join('coaches', 'registrations.coach_id', 'coaches.id')
                ->select('registrations.*', 'programs.program_name', 'coaches.nick_name');
            }
        ])
        ->join('members', 'members.code', 'voucher_merchandises.member_code')
        ->join('batches', 'batches.id', 'voucher_merchandises.batch_id')
        ->where('qr_code', $code)
        ->select('voucher_merchandises.*', 'members.member_name', 'batches.batch_name', 'batches.merchandise_voucher')
        ->first();
    }

    public static function getListOfVouchers($batchId, $limitData, $searchMember = null) {
        return VoucherMerchandise::with([
            'registration' => function ($query) {
                $query->join('programs', 'registrations.program_id', 'programs.id')
                ->join('coaches', 'registrations.coach_id', 'coaches.id')
                ->select('registrations.*', 'programs.program_name', 'coaches.nick_name');
            }
        ])
        ->join('members', 'members.code', 'voucher_merchandises.member_code')
        ->join('batches', 'batches.id', 'voucher_merchandises.batch_id')
        ->where('batch_id', $batchId)
        ->select('voucher_merchandises.*', 'members.member_name', 'members.mobile_phone as no_wa', 'batches.batch_name', 'batches.merchandise_voucher as discount')
        ->orderBy('id', 'desc')
        ->when($searchMember != null, function ($query) use ($searchMember) {
            $query->where('members.member_name', 'like', '%' . $searchMember . '%');
        })
        ->paginate($limitData);
    }
}
