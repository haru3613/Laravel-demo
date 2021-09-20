<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return User::select(['*'])
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
    public function registerAccount(string $name, string $account, string $password)
    {
        try {
            return User::create([
                'name' => $name,
                'account' => $account,
                'password' => Hash::make($password),
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
