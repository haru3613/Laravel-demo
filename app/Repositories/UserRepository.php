<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;

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
            dd();
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
            dd();
        }
    }

    /**
     * 建立使用者
     *
     * @param array $data 帳號
     * @return mixed
     */
    public function registerAccount(string $name, string $account, string $password, string $phone_number)
    {
        DB::beginTransaction();
        try {
            $phones = new Phone();
            $phones->phone_number = $phone_number;
            $phones->save();

            $users = new User();
            $users->name = $name;
            $users->account = $account;
            $users->password = $password;
            $users->phone_id = $phones->id;
            $users->save();

            DB::commit();
            return $users;
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
