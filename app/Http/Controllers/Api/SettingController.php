<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function settings(){

        $setting = Setting::all();

        if($setting){

            return apiResponse(1,'success',$setting);
        }else{


            return apiResponse(0,'failed',$setting);
        }

    }
}
