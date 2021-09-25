<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Services\PostService;
use App\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var PostRepository
     */
    protected $post_repository_mock;

    /**
     * @var PostService
     */
    protected $post_service;

    /**
     * 在每個 test case 開始前執行.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->post_repository_mock = Mockery::mock(PostRepository::class);
        $this->post_service = new PostService($this->post_repository_mock);
    }

    /**
     * 測試 建立文章Service處理成功
     */
    public function testCreatePostSuccess()
    {
        $post = Post::factory()->create();
        $fake_input = [
            'title' => '測試標題',
            'content' => '測試內文',
        ];
        $this->post_repository_mock
            ->shouldReceive('createPost')
            ->once()
            ->andReturn($post);
        $actual_result = $this->post_service->create($fake_input);
        $this->assertEquals($post->title, $actual_result['title']);
        $this->assertEquals($post->content, $actual_result['content']);
        $this->assertEquals($post->user_id, $actual_result['user_id']);
    }
}
