<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{
    use HasFactory;

    public static function send_sms($api_token, $endpoint, $sender_id, $recipient, $message) {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode([
                'recipient' => $recipient,
                'sender_id' => $sender_id,
                'message' =>  $message
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                "accept: application/json",
                "authorization: Bearer ".$api_token,
            ],
        ]);

        $resp = curl_exec($ch);
        if ($e = curl_error($ch)) {
            echo $e;
        }
    }
}
