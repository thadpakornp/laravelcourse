<?php

namespace App\Http\Controllers;

use App\Helpers\Line;
use App\Helpers\Loggin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LineController extends Controller
{
    public function index()
    {
        $data = User::first();
        // $data = User::get();

        return response()->json($data);
    }

    public function login(Request $r)
    {
        $user = User::where('email', $r->email)->first();
        if (empty($user)) {
            return response()->json('Not Found', 404);
        }

        if (!Hash::check($r->password, $user->password)) {
            return response()->json('Password invalid', 404);
        }

        $getToken = $user->createToken($r->email);
        $data = [
            'access_token' => $getToken->accessToken,
            'token_type' => 'Bearer'
        ];
        return response()->json($data);
    }

    public function getLineData(Request $request)
    {
        $array = ['ซื้อ'];
        $data = $request->all();
        $text = Loggin::save($data);

        //สั่งซื้อ
        if (in_array($array, $text)) {
            $this->store($data);
        } elseif ($text['text'] == 'ขายอะไร') {
            $d = $this->description();

            $jsonReply["replyToken"] = $text['replyToken'];
            $jsonReply["messages"][0] = $d;

            $result = Line::Pushback($jsonReply);
        } elseif ($text['text'] == 'ใครอยากรับอะไรไหม') {
            $this->sell($data);
        }
    }

    private function store($req)
    {
    }

    private function description()
    {
        //connect get data from database
        // $return from database;
        return 'D';
    }

    private function sell($data)
    {
    }
}
