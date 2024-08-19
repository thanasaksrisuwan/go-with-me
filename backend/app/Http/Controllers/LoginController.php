<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNoti;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'phone' =>'required|numeric|min:10',
        ]);

        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);
        
        if (! $user) {
            return response()->json(['message' => 'error'], 401);
        }

        try {
            $user->notify(new LoginNoti());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return response()->json(['message' => 'The message was sent.']);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999'
        ]);

        $user = User::where('phone', $request->phone)
        ->where('login_code', $request->login_code)
        ->first();

        if ($user) {
            $user->update([
                'login_code' => null
            ]);
            return $user->createToken($request->login_code)->plainTextToken;
        }

        return response()->json(['message' => 'Invalid code.'], 401);
    }
}
