<?php

namespace App\Repositories;

use Exception;
use App\Models\User;

class UserRepository
{
    /**
     * 搜尋使用者
     *
     * @param string $username 帳號
     * @return mixed
     */
    public function searchUserByAccount(string $account)
    {
        try {
            return User::select(['name', 'account', 'password'])
                ->where('account', $account)
                ->first();
        } catch (Exception $e) {
            dd();
        }
    }

    /**
     * 搜尋使用者
     *
     * @param string $username 帳號
     * @return mixed
     */
    public function getUserPaginate(int $limit)
    {
        try {
            return User::paginate($limit);
        } catch (Exception $e) {
            dd();
        }
    }

    /**
     * 搜尋使用者
     *
     * @param string $username 帳號
     * @return mixed
     */
    public function registerAccount(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            dd();
        }
    }
}
