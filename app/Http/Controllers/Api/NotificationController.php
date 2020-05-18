<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function notifications(){

        $notification = Notification::all();

        if ($notification){

            return apiResponse(1,'success',$notification);
        }else{


            return apiResponse(0,'Field',$notification);
        }

    }
}
