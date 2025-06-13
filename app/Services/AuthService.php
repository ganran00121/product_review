<?php

namespace App\Services;


use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $data['role_id']  = 2; // Configure Role member
        return $this->userRepositoryInterface->create($data);
    }

    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function currentUser()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }

    public function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
