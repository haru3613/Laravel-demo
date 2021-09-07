<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $result = $this->service->login($account, $password);
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['status' => 1, 'message' => 'invalid credentials'], 401);
        }

        return response()->json(['status' => 0, 'token' => $token]);
    }

    public function register(Request $request)
    {
        dd($request->all());
        $result = $this->service->register($request->all());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => 0]);
    }
}
