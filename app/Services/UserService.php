<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function getUserPaginate(int $limit)
    {
        return $this->user_repository->getUserPaginate($limit);
    }
}
