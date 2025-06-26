<?php

namespace App\Services;

use App\Models\Batch;
use App\Models\WorkshopBatch;

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

    public static function batchQuery() {
        $activeBatch = Batch::where('batch_status', 'Active')->exists();
        $openBatch = Batch::where('batch_status', 'Open')->exists();

        if($openBatch) {
            $batch = Batch::where('batch_status', 'Open')->first();
        } elseif ($activeBatch) {
            $batch = Batch::where('batch_status', 'Active')->first();
        }
        else {
            $batch = Batch::orderBy('id', 'desc')
            ->limit(1)
            ->first();
        }

        return $batch;
    }

    public function renewalMemberPercent($renewalMember, $qtyLastMember) {


        if ($qtyLastMember == 0) {
            $percent = 0;
        } else {
            $percent = Round(($renewalMember/$qtyLastMember) * 100,2);
        }

        return $percent;
    }

    public function workshopBatchQuery() {
        $activeBatch = WorkshopBatch::where('batch_status', 'Active')->exists();
        $openBatch = WorkshopBatch::where('batch_status', 'Open')->exists();

        if($openBatch) {
            $batch = WorkshopBatch::where('batch_status', 'Open')->first();
        } elseif ($activeBatch) {
            $batch = WorkshopBatch::where('batch_status', 'Active')->first();
        }
        else {
            $batch = WorkshopBatch::orderBy('id', 'desc')
            ->limit(1)
            ->first();
        }

        return $batch;
    }

    //Get last 3 active batch
    public function getLastBatch() {
        return Batch::orderBy('id', 'desc')
        ->limit(3)
        ->get();
    }
}
