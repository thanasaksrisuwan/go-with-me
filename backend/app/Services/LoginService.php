<?php

namespace App\Services;
use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\User;
use App\Notifications\LoginNoti;

class LoginService {
    use ResponseHelper;

    public function login(LoginRequest $request) {
        $user = User::firstOrCreate(
            [
                'phone' => $request->phone
            ],
            [
                'phone' => $request->phone
            ]
        );

        if (!$user) {
            return $this->successResponse(null, 'User not found', 404);
        }

        try {
            $user->notify(new LoginNoti());
        } catch (\Exception $e) {
            return $this->errorResponse('Internal error', 500, $e->getMessage());
        }

        return $this->successResponse(null, 'The code has been sent.', 200);
    }

    public function verify(VerifyRequest $request) {
        $user = User::query()
            ->where('phone', $request->phone)
            ->where('login_code', $request->login_code)
            ->first();

        if ($user) {
            $user->update([
                'login_code' => null,
            ]);

            return $this->successResponse([
                'access_token' => $user->createToken($request->phone)->accessToken,
                'token_type' => 'Bearer',
            ]);
        }

        return $this->errorResponse('Invalid code', 400);
    }
}