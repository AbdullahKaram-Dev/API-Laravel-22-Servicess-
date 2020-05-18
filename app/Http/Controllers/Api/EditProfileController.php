<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;


class EditProfileController extends Controller
{

    public function update(Request $request){

        $validator = validator()->make($request->all(),[
            'phone'=>'numeric',
            'email'=>'email|unique:clients,email,'.auth()->user()->id,
            'password'=>'string',
            'name'=>'string',
            'date_of_birth'=>'date',
            'blood_type'=>'string',
            'last_donation_date'=>'date',
            'city_id'=>'exists:cities,id'
        ]);

        if($validator->fails()){

            return apiResponse(0,$validator->errors()->first(),$validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        //$request->user()->id;
        $user = Client::where('api_token',$request->api_token)->first();
        $user->update($request->all());
        if($user){

            return apiResponse(1,'updated successful',$user);
        }else{

            return apiResponse(0,'Field Update');
        }
    }
}
