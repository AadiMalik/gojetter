<?php

namespace App\Services\Concrete\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function signup(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->assignRole('user');

        $token = auth()->login($user);

        return ['user' => $user, 'token' => $token];
    }

    public function login(array $data): array
    {
        // Determine if login is email or username only (no phone)
        $loginField = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($loginField, $data['login'])->first();

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

        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        return [
            'user' => $user
        ];
    }
}
