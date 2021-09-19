<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Arr;

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

        return auth('api')->fromUser($user);
    }

    public function register(array $data)
    {
        $name = Arr::get($data, 'name');
        $account = Arr::get($data, 'account');
        $password = Arr::get($data, 'password');
        $phone_number = Arr::get($data, 'phone_number');
        $user = $this->user_repository->registerAccount($name, $account, $password, $phone_number);

        if ($user === null) {
            // TODO DataEmpty
            dd($user);
        }
        return $user;
    }
}
