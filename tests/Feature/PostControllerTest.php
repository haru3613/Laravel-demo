<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var API Header
     */
    protected $header = [
        'X-Requested-With' => 'XMLHttpRequest',
        'Content-Type'     => 'application/json',
    ];

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->header["Authorization"] = $this->createToken($user);
    }

    /**
     * 測試 建立文章成功
     */
    public function testCreatePostSuccess()
    {
        $fake_data = [
            'title' => '測試標題',
            'content' => '測試內文',
        ];

        $response = $this->withHeaders($this->header)->postJson(Route('post.create'), $fake_data)->decodeResponseJson();

        $this->assertTrue($response['title'] == $fake_data['title']);
        $this->assertTrue($response['content'] == $fake_data['content']);
    }
}
