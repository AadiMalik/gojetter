<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Http\Requests\Api\CustomerLoginRequest;
use App\Http\Requests\Api\CustomerSignupRequest;
use App\Http\Requests\Api\ForgetPasswordRequest;
use App\Http\Requests\Api\ResendEmailOtpRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
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

    //verify email otp
    public function verifyEmailOtp(VerifyEmailOtpRequest $request)
    {
        $result = $this->authService->verifyEmailOtp($request->validated());

        return $this->success(
            $result['user'],
            ResponseMessage::OTP_VERIFIED
        );
    }

    //forget password
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $result = $this->authService->forgetPassword($request->validated());

        return $this->success(
            $result,
            ResponseMessage::OTP_SENT
        );
    }

    //change password
    public function changePassword(ChangePasswordRequest $request)
    {
        $result = $this->authService->changePassword($request->validated());

        return $this->success(
            $result,
            ResponseMessage::PASSWORD_CHANGED
        );
    }

    //update profile
    public function updateProfile(UpdateProfileRequest $request)
    {

        $obj = $request->validated();
        if ($request->hasFile('avatar')) {
            $obj['avatar'] = $request->file('avatar')->store('users', 'public');
        }
        $result = $this->authService->updateProfile($obj);
        return $this->success(
            $result,
            ResponseMessage::UPDATE
        );
    }

    //delete account
    public function deleteAccount()
    {
        $result = $this->authService->deleteAccount();

        return $this->success(
            $result,
            ResponseMessage::ACCOUNT_DELETED
        );
    }
}
