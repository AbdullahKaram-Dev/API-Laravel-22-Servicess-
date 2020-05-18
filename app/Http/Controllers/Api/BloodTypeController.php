<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;

class BloodTypeController extends Controller
{
    public function bloodType(){

        $BloodType = BloodType::all();

        if($BloodType){

            return apiResponse(1,'success',$BloodType);
        }else{


            return apiResponse(0,'Filed',$BloodType);
        }

    }
}
