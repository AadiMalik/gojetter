<?php

namespace App\Services\Concrete\Api;

use App\Mail\SendOtpMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function signup(array $data): array
    {
        try {
            DB::beginTransaction();
            $otp = rand(100000, 999999);
            $user = User::create([
                'name'     => $data['name'],
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'email_otp' => $otp,
                'email_otp_expires_at' => now()->addMinutes(config('auth.otp_expiry_minutes'))
            ]);

            $user->assignRole('user');

            $token = auth()->login($user);
            Mail::to($user->email)->send(new SendOtpMail($user));

            DB::commit();
        } catch (Exception $e) {

            DB::rollback();
            throw $e;
        }
        return ['user' => $user, 'token' => $token];
    }

    public function login(array $data): array
    {
        // Determine if login is email or username only (no phone)
        $loginField = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($loginField, $data['login'])->where('is_deleted', 0)->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Invalid login credentials.'],
            ]);
        }

        if (!$user->hasRole('user')) {
            throw ValidationException::withMessages([
                'login' => ['Only users with "user" role are allowed to login.'],
            ]);
        }

        if (is_null($user->email_verified_at)) {
            // Generate and send OTP
            $otp = rand(100000, 999999);
            $user->update([
                'email_otp' => $otp,
                'email_otp_expires_at' => now()->addMinutes(config('auth.otp_expiry_minutes')),
            ]);

            Mail::to($user->email)->send(new SendOtpMail($user));

            throw ValidationException::withMessages([
                'login' => ['Email not verified. OTP has been sent to your email.'],
            ]);
        }
        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        return [
            'user' => $user
        ];
    }

    public function resendEmailOtp($data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!is_null($user->email_verified_at)) {
            throw ValidationException::withMessages([
                'login' => ['Email is already verified.'],
            ]);
        }
        $otp = rand(100000, 999999);
        $user->update([
            'email_otp' => $otp,
            'email_otp_expires_at' => now()->addMinutes(config('auth.otp_expiry_minutes')),
        ]);

        // Send email
        Mail::to($user->email)->send(new SendOtpMail($user));
        return true;
    }

    public function verifyEmailOtp($data)
    {
        $user = User::where('email', $data['email'])
            ->where('email_otp', $data['otp'])
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'login' => ['Invalid OTP or email.'],
            ]);
        }

        if (now()->greaterThan($user->email_otp_expires_at)) {
            throw ValidationException::withMessages([
                'login' => ['OTP expired. Please request a new one.'],
            ]);
        }

        $user->update([
            'email_verified_at' => now(),
            'email_otp' => null,
            'email_otp_expires_at' => null,
        ]);

        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        return [
            'user' => $user
        ];
    }

    //forget password
    public function forgetPassword($data)
    {
        $user = User::where('email', $data['email'])->first();
        $otp = rand(100000, 999999);
        $user->update([
            'email_otp' => $otp,
            'email_otp_expires_at' => now()->addMinutes(config('auth.otp_expiry_minutes')),
        ]);

        // Send email
        Mail::to($user->email)->send(new SendOtpMail($user));
        return true;
    }

    //change password
    public function changePassword($data)
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'password' => Hash::make($data['password'])
        ]);
        return true;
    }
    // update profile
    public function updateProfile($data)
    {
        $user = Auth::user();
        $user->fill($data); 
        $user->save();

        return $user;
    }
    //delete account
    public function deleteAccount()
    {
        $user = User::find(Auth::user()->id);
        $user->update([
            'is_deleted' => 1,
            'date_deleted' => Carbon::now(),
            'deletedby_id' => Auth::user()->id
        ]);
        return true;
    }
}
