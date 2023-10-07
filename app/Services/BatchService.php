<?php

namespace App\Services;

use App\Models\Batch;

class BatchService {

    public function batchId() {
        $batch = Batch::latest('id')->first();
        $batchId = $batch->id;

        return $batchId;
    }
}
