<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Governorate;


class GovernorateController extends Controller
{
    public function governorates()
    {

        $governorates = Governorate::all();

        return apiResponse(1, 'success', $governorates);

    }
}
