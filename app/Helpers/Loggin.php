<?php

namespace App\Helpers;

use App\Models\LogginLine;

class Loggin
{

    public static function save($data)
    {
        try {
            $LineData = [
                'userID' => $data["events"][0]["source"]["userId"],
                'text' => $data["events"][0]["message"]["text"],
                'type' => $data["events"][0]["message"]["type"],
                'replyToken' => $data["events"][0]["replyToken"],
                // 'recivedtime' => $data["events"][0]["timestamp"],
                // 'jsonData' => $data
            ];

            if ($LineData['type'] == 'text') {
                LogginLine::create($LineData);
            }
            return $data;
        } catch (\Throwable $th) {
            file_put_contents('error_loggin_' . date('YmdHis'), $th->getMessage());
        }
    }
}


// {
//     "destination": "Ua0343aa97924b261da9bd5362039",
//     "events": {
//         "0": {
    //          "replyToken": "29e4fe9d921a430680635a681fa53da0",
    //          "timestamp": "156414582",
    //          "type": "message",
    //          "message": {
        //           "id": "10281586537",
        //           "type": "text",
        //           "text": "Hello"
    //          },
//          "source": {
    //           "type": "user",
    //           "userId": "U1efbc797c7174dd636c047f5ca8e"
//              }
//         }
//     }
// }
