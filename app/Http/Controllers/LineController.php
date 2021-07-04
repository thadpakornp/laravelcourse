<?php

namespace App\Http\Controllers;

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
}
