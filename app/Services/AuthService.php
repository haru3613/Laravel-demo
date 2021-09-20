<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    /**
     * @var UserRepository
     */
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function login(string $account, string $password)
    {
        $user = $this->user_repository->searchUserByAccount($account);

        // 密碼不符
        if (! Hash::check($password, $user->password)) {
            // TODO error handler
            dd('password not matched');
        }

        return JWTAuth::fromUser($user);
    }

    public function register(array $data)
    {
        $name = Arr::get($data, 'name');
        $account = Arr::get($data, 'account');
        $password = Arr::get($data, 'password');
        $user = $this->user_repository->registerAccount($name, $account, $password);

        if ($user === null) {
            // TODO DataEmpty
            dd($user);
        }
        return $user;
    }
}
