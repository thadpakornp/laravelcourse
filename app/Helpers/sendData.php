<?php

namespace App\Helpers;

class Line
{
    public static function Pushback($replyJson)
    {
        $ch = curl_init(config('app.LineReplyURL'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . config('app.LineAccessToken')
            )
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $replyJson);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
