<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerLoginRequest;
use App\Http\Requests\Api\CustomerSignupRequest;
use App\Services\Concrete\Api\AuthService;
use App\Traits\ResponseAPI;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResponseAPI;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(CustomerSignupRequest $request)
    {
        $result = $this->authService->signup($request->validated());

        return $this->success(
            $result,
            ResponseMessage::REGISTER
        );
    }

    public function login(CustomerLoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        return $this->success(
            $result['user'],
            ResponseMessage::LOGIN
        );
    }

    public function logout()
    {
        auth()->logout();

        return $this->success(
            [],
            ResponseMessage::LOGOUT
        );
    }
}
