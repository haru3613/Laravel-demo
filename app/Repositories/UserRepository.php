<?php

namespace App\Repositories;

use Exception;
use App\Models\User;

class UserRepository
{
    /**
     * 透過帳號搜尋特定使用者
     *
     * @param string $account 帳號
     * @return mixed
     */
    public function searchUserByAccount(string $account)
    {
        try {
            return User::select(['name', 'account', 'password'])
                ->where('account', $account)
                ->first();
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * 取得使用者
     *
     * @param int $limit 帳號
     * @return mixed
     */
    public function getUserPaginate(int $limit)
    {
        try {
            return User::paginate($limit);
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * 建立使用者
     *
     * @param array $data
     * @return mixed
     */
    public function registerAccount(array $data)
    {
        try {
            return User::create($data);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
