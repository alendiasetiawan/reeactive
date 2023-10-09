<?php

namespace App\Services;

use App\Models\Batch;

class BatchService {

    public function batchIdActive() {
        $activeBatch = Batch::where('batch_status', 'Active')->exists();
        $openBatch = Batch::where('batch_status', 'Open')->exists();

        if($openBatch) {
            $batch = Batch::where('batch_status', 'Open')->first();
            $batchId = $batch->id;
        } elseif ($activeBatch) {
            $batch = Batch::where('batch_status', 'Active')->first();
            $batchId = $batch->id;
        }
        else {
            $batch = Batch::orderBy('id', 'desc')
            ->limit(1)
            ->first();
            $batchId = $batch->id;
        }

        return $batchId;
    }

    public function renewalMemberPercent($renewalMember, $qtyLastMember) {

        $percent = Round(($renewalMember/$qtyLastMember) * 100,2);

        return $percent;
    }
}
