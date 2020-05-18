<?php

namespace App\Http\Controllers\Api;

use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function registerToken(Request $request){



        $validation = validator()->make($request->all(),[

           'token'=>'required',
           'type'=>'required|in:ios,android'

        ]);

        if($validation->fails()){

            $data = $validation->errors();

            return apiResponse(0,$validation->errors()->first(),$data);

        }

        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return apiResponse(1,'Success Register');

    }


    public function removeToken(Request $request){

        $validation = validator()->make($request->all(),[

           'token'=>'required'
        ]);

        if($validation->fails()){

            $data = $validation->errors();
            return apiResponse(0,$validation->errors()->first(),$data);

        }

        Token::where('token',$request->token)->delete();
        return apiResponse(1,'successful delete');

    }


    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'phone' => 'required|numeric|digits:11',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'name' => 'required',
            'date_of_birth' => 'required|date',
            'blood_type' => 'required|in:o-,o+,B-,B+,A+,A-,AB-,AB+',
            'last_doniation_date' => 'required|date',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();

        return apiResponse(1, 'success', [
            'api_toke' => $client->api_token,
            'client' => $client
        ]);

    }


    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return apiResponse(1, 'Right Data Entered', [

                    'api_token' => $client->api_token,
                    'client' => $client
                ]);

            } else {
                return apiResponse(0, 'Wrong Data Entered');

            }
        }


    }

    public function ResetPassword(Request $request)
    {

        $user = Client::where('phone', $request->phone)->first();
        if ($user) {

            $code = rand(1111, 9999);
            $update = $user->update(['pin_code' => $code]);

            if ($update) {


                // this code send sms
                // smsMisr($request->phone,'Your reset code Is : '. $code);

                // this code will send email

                Mail::to($user->email)
                    ->bcc("abdallakaramdev@gmail.com")
                    ->send(new ResetPassword($code));


                return apiResponse(1, 'search your phone', ['pin_code_for_test' => $code]);
            } else {

                return apiResponse(0, 'There is an error please try again');
            }
        } else {

            return apiResponse(0, 'there is not found any account fro this phone');
        }
    }


    public function newPassword(Request $request)
    {

        $validation = validator()->make($request->all(), [
            'pin_code' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return apiResponse(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)
            ->where('phone', $request->phone)->first();

        if ($user) {
            $user->password = bcrypt($request->password);
            $user->pin_code = null;

            if ($user->save()) {
                return apiResponse(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return apiResponse(0, 'حدث خطأ ، حاول مرة أخرى');
            }
        } else {
            return apiResponse(0, 'هذا الكود غير صالح');
        }
    }


}
