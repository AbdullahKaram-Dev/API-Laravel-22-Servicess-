<?php

namespace App\Http\Controllers\Api;

use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonationRequest;

class DonationRequestController extends Controller
{

public function donationRequestCreate(Request $request)
{
    $rules = [

        'patient_name' => 'required',
        'patient_age' => 'required:digits',
        'blood_type_id' => 'required',
        'bags_number' => 'required:digits',
        'hospital_address' => 'required',
        'city_id' => 'required|exists:cities,id',
        'patient_phone' => 'required|digits:14',

           ];

    $validator = validator()->make($request->all(),$rules);

    if($validator->fails()){

        return apiResponse(0,$validator->errors()->first(),$validator->errors());

    }


    $donationRequest = $request->user()->donations()->create($request->all());


    $clientsIds = $donationRequest->city->governorate->clients()
        ->whereHas('bloodtypes',function ($q) use ($request,$donationRequest){

            $q->where('blood_types.id',$donationRequest->blood_type_id);

        })->pluck('clients.id')->toArray();


    if (count($clientsIds)){

        $notification = $donationRequest->notification()->create([

            'title'=> 'i need helper',
            'content'=> $donationRequest->blood_type.'i need help',

        ]);

        $notification->clients()->attach($clientsIds);

        $tokens = Token::whereIn('client_id',$clientsIds)->where('token','!=',null)->pluck('token')->toArray();
       if(count($tokens)){

            $title = $notification->title;
            $content  = $notification->content;

            $data = [
                'action'=> 'new notification',
                'data' => null,
                'client' => 'client',
                'title' => $notification->title,
                'content' => $notification->content,
                'donation_request_id' => $donationRequest->id
            ];
           // info(json_encode($data));

            $send = notifyByFirebase($title,$content,$tokens,$data);
            //info($send);
            //info('firebase result'.$send);

        }
    }

        return apiResponse(1,'add success',$donationRequest->load('city'));
}


    public function notificationsSettings(Request $request)
    {
        $rules = [
            'governorates.*' => 'exists:governorates,id',
            'blood_types.*'  => 'exists:blood_types,id',
        ];
        // governorates == [1,5,13]
        // blood_types == [1,3]
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        if ($request->has('governorates')) {

            // $arr = [1,2];
            // sync (1,2,4,5,6)
            // 1,2,4,5,6

            $request->user()->governorates()->sync($request->governorates); // attach - detach() - toggle() - sync
        }

        if ($request->has('blood_types')) {
            $request->user()->bloodtypes()->sync($request->blood_types);
        }

        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(), // [1,3,4]
            // {name: asda , 'created' : asdasd , id: asdasd}
            // [1,5,13]
            'blood_types'  => $request->user()->bloodtypes()->pluck('blood_types.id')->toArray(),
        ];
        return apiResponse(1, 'تم  التحديث', $data);
    }




































    public function AllDonationRequest(Request $request)
    {
        if ($request) {

            $donations = DonationRequest::with('client')->get();

            return apiResponse(1, 'Success To Get All Donation', $donations);

        } else {

            return apiResponse(0, 'Filed To Get Data');
        }

    }

















    public function DonationRequest($id, Request $request)
    {

        if ($request->id) {


            $donation = DonationRequest::findOrFail($id)->where('id', $id)->with('client')->get();

            return apiResponse(1, 'Success To Get Donation By Id', $donation);

        } else {


            return apiResponse(0, 'Filed To Get Donation By Id');
        }

    }


}
