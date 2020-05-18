<?php


function apiResponse($status, $message, $data=null){

    $response = [

        'status'=> $status,
        'message'=> $message,
        'data'=> $data
    ];

    return response()->json($response);

}


/**
 * @param $to
 * @param $message
 * @return mixed
 */
function smsMisr($to, $message)
{
    $url = 'https://smsmisr.com/api/webapi/?';
    $push_payload = array(

      "username" => "*****",
      "password" => "*****",
      "language" => "2",
      "sender" => "Body",
      "mobile" => '2' . $to,
      "message" => $message,
    );

    $rest = curl_init();
    curl_setopt($rest,CURLOPT_URL,$url.http_build_query($push_payload));
    curl_setopt($rest,CURLOPT_POST,1);
    curl_setopt($rest,CURLOPT_POSTFIELDS,$push_payload);
    curl_setopt($rest,CURLOPT_SSL_VERIFYPEER,true);
    curl_setopt($rest,CURLOPT_HTTPHEADER,

        array(

            "Content-Type" => "application/x-www-form-urlencoded"

        ));

    curl_setopt($rest,CURLOPT_RETURNTRANSFER,1);

    $response = curl_exec($rest);

    curl_close($rest);

    return $response;

}




function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{

    $registrationIDs = $tokens;

// prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support

// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)

// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );
    //dd(env('FIREBASE_API_ACCESS_KEY'));
    $headers = array(
        'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}