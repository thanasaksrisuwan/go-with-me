<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNoti;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // validate phone

        $request->validate([
            'phone' =>'required|numeric|min:10',
        ]);
        // create a user
        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);
        
        if (! $user) {
            return response()->json(['message' => 'error'], 401);
        }

        // send the user code
        $user->notify(new LoginNoti());

        // response
    }
}
