<?php

namespace App\Http\Controllers\CompanyProfile;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    public function private() {
        $data = [
            'title' => 'Program Private 1 on 1',
            'coachs' => Coach::coachPricing(),
        ];

        return view('landing.private', $data);
    }
}
