<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $this->authService->register($validated);

        return response()->json(['message' => 'User created successfully']);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = $this->authService->login($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json($this->authService->respondWithToken($token));
    }

    public function me()
    {
        return response()->json($this->authService->currentUser());
    }

    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
