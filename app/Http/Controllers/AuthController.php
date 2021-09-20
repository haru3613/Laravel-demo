<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthService $service)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->service = $service;
    }

    public function login(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $token = $this->service->login($account, $password);

        if ($token !== false) {
            $result = [
                'token_type' => 'Bearer',
                'access_token' => $token,
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ];
        }

        return response()->json($result);
    }

    public function register(Request $request)
    {
        $result = $this->service->register($request->all());
        return response()->json($result);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => 0]);
    }
}
