<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 產生 jwt 驗證 token
     *
     * @return mixed
     */
    protected function createToken($user)
    {
        $token = JWTAuth::fromUser($user);

        return 'Bearer '.$token;
    }
}
