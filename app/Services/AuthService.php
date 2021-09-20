<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        if ($user === null) {
            // TODO DataEmpty
            dd($user);
        }

        return JWTAuth::fromUser($user);
    }

    public function register(array $data)
    {
        $user = $this->user_repository->registerAccount($data);

        if ($user === null) {
            // TODO DataEmpty
            dd($user);
        }
        return $user;
    }
}
