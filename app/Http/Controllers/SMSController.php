<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;

class SMSController extends Controller
{

    public static function Send($Number,$Text)
    {
        return  http::get(config('services.clickatell.url'),[
        'apiKey' => config('services.clickatell.api_key'),
        'to' => $Number,
        'content' => $Text
        ]);
    }


    public static function Twillo($number = null, $body)
    {


        if($number){
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);

            try {
            $client->messages->create('+'.$number, [
            'from' => $twilio_number,
            'body' => $body
            ]);
            } catch (\Twilio\Exceptions\RestException $e) {
            error_log($e);
            }
        }
    }
}
