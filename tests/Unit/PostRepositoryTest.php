<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\JWTGuard;
use Mockery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PostRepository;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var PostRepository
     */
    protected $post_repository;

    /**
     * 在每個 test case 開始前執行.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->post_repository = app()->make(PostRepository::class);
        $this->user = User::factory()->create();
        $this->guard_mock = Mockery::mock(JWTGuard::class);
        Auth::shouldReceive('guard')
            ->with('api')
            ->andReturn($this->guard_mock);
        $this->guard_mock->shouldReceive('user')
            ->andReturn($this->user);
    }

    /**
     * 測試 成功建立文章
     */
    public function testCreatePostShouldSuccess()
    {
        $title = "測試標題";
        $content = "測試內文";
        $this->post_repository->createPost($title, $content);
        $this->assertDatabaseHas('posts', [
            'user_id' => $this->user->id,
            'title' => $title,
            'content' => $content,
        ]);
    }
}
