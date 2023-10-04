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
            'coaches' => Coach::privatePricing(),
        ];

        return view('landing.private', $data);
    }

    public function buddySmall() {
        $data = [
            'title' => 'Program Buddy/Small Groups',
            'buddyCoaches' => Coach::buddyPricing(),
            'smallCoaches' => Coach::smallPricing(),
        ];

        return view('landing.buddy-small', $data);
    }

    public function specialCase() {
        $data = [
            'title' => 'Program Special Case Groups',
            'specialCaseCoaches' => Coach::specialCasePricing(),
        ];

        return view('landing.special-case', $data);
    }

    public function large() {
        $data = [
            'title' => 'Program Large Groups',
            'largeCoaches' => Coach::largePricing(),
        ];

        return view('landing.large', $data);
    }
}
