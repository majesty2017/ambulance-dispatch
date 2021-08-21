<?php

namespace App\Http\Controllers;

use App\Models\SmsConfig;
use Illuminate\Http\Request;

class SmsConfigController extends Controller
{
    public static function send_sms($phone, $message)
    {
        $sms_config = SmsConfig::where('id', 1)->first();
        $endpoint = $sms_config->endpoint;
        $api_token = $sms_config->api_token;
        $sender_id = $sms_config->sender_id;
        $phone = preg_replace('/^0/', '233', $phone);
        SmsConfig::send_sms($api_token, $endpoint, $sender_id, $phone, $message);
    }
}
