<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerLoginRequest;
use App\Http\Requests\Api\CustomerSignupRequest;
use App\Http\Requests\Api\ResendEmailOtpRequest;
use App\Http\Requests\Api\VerifyEmailOtpRequest;
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
            ResponseMessage::OTP_SENT
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

    public function resendEmailOtp(ResendEmailOtpRequest $request)
    {
        $result = $this->authService->resendEmailOtp($request->validated());

        return $this->success(
            $result,
            ResponseMessage::OTP_SENT
        );
    }

    public function verifyEmailOtp(VerifyEmailOtpRequest $request)
    {
        $result = $this->authService->verifyEmailOtp($request->validated());

        return $this->success(
            $result['user'],
            ResponseMessage::OTP_VERIFIED
        );
    }
}
