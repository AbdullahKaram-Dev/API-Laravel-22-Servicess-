<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function contacts(Request $request){

        $validator = Validator()->make($request->all(),[

            'phone' => 'required|min:11',
            'email' => 'required|email',
            'title_message' => 'required|min:5',
            'message' => 'required|min:5'
        ]);

        if($validator->fails()){

            return apiResponse(0,$validator->errors()->first(),$validator->errors());
        }

            $contact = Contact::create($request->all());
            $contact->save();
            return apiResponse(1,'success',$contact);

    }
}
