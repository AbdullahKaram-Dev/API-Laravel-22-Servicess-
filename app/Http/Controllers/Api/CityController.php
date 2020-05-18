<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\City;


class CityController extends Controller
{

    public function cities(Request $request)
    {

        $cities = City::where(function ($query) use ($request) {
            if ($request->has('governorate_id')) {

                $query->where('governorate_id', $request->governorate_id);
            }

        })->get();

        return apiResponse(1, 'success', $cities);
    }
}
