<?php

namespace App\Http\Controllers;

use App\Helpers\Line;
use App\Helpers\Loggin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LineController extends Controller
{
    // public function __construct()
    // {
    //     $this->product = User::get();
    // }

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

        // $arrayp = []; // ['A','B','C']
        // $array = User::get(['name_product']); //[{ 0 => 'A', 1=> 'B', 2=> 'C'}]
        // foreach ($array as $key => $value) {
        //     array_push($arrayp, $value->name_product);
        // }
        $array = ['ส้ม', 'มะม่วง'];

        $data = $request->all();
        $result = Loggin::save($data);


        $textsult = $result['text']; //ต้องการซื้อส้ม

        //search ซื้อ
        // 1 strstr(text,wording)
        // 2 strpos(text, wording), strrpos(text, wording)
        if (strstr($textsult, 'ซื้อ')) {
            //found
            //strrpos($textsult, 'ซื้อ') return true
            //in_array(array,wording)

            // if (in_array($array, $textsult)) {
            //     foreach ($variable as $key => $value) {
            //         # code...
            //     }
            // }

            $array = User::get(['name']); //[{ 0 => 'A', 1=> 'B', 2=> 'C'}]
            foreach ($array as $key => $value) {
                if (stripos($textsult, $value->name)) {
                    return 'OK';
                }
            }
            return 'Found';
        }

        if (strstr($textsult, 'ขาย')) {
            //ขาย
            //return false
            // strstr($textsult, 'กืโล', 'กืโลกรัม');
            $arr_str = explode(" ", $textsult); // return array {0=> 'วันนี้มีส้มมาขาย',1=>'10'}
            // $t = Str::beforeLast($textsult, 'บาท');
            $indexBath = array_search("บาท", $arr_str) - 1;
            // $indexB = $arr_str.indexOf("บาท"); //javascript
            return $arr_str[$indexBath];
        }

        // $this->searchwording($textsult, " ");


        //สั่งซื้อ
        // if (in_array($array, $text)) {
        //     $this->store($data);
        // } elseif ($text['text'] == 'ขายอะไร') {
        //     $d = $this->description();

        //     $jsonReply["replyToken"] = $text['replyToken'];
        //     $jsonReply["messages"][0] = $d;

        //     $result = Line::Pushback($jsonReply);
        // } elseif ($text['text'] == 'ใครอยากรับอะไรไหม') {
        //     $this->sell($data);
        // }
    }

    private function searchwording($text, $wording)
    {
        strstr($text, $wording);
        $arr_str = explode($wording, $text);

        return $arr_str; //wording
    }

    private function searchwordings($text, $wording)
    {
        strstr($text, $wording);
        $arr_str = explode($wording, $text);

        return $arr_str; //text , index
    }

    // private function store($req)
    // {
    // }

    // private function description()
    // {
    //     //connect get data from database
    //     // $return from database;
    //     return 'D';
    // }

    // private function sell($data)
    // {
    // }
}
