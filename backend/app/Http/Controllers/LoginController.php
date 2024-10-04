<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\User;
use App\Notifications\LoginNoti;
use App\Services\LoginService;

class LoginController extends Controller
{
    use ResponseHelper;
    
    protected $loginService;
    public function __construct(LoginService $loginService) {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        return $this->loginService->login($request);
    }

    public function verify(VerifyRequest $request)
    {
        return $this->loginService->verify($request);
    }

}
