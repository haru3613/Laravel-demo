<?php

namespace App\Services;

use Yish\Generators\Foundation\Service\Service;
use App\Repositories\PostRepository;
use Illuminate\Support\Arr;

class PostService
{
    /**
     * @var PostRepository
     */
    protected $post_repository;

    public function __construct(PostRepository $post_repository)
    {
        $this->post_repository = $post_repository;
    }

    /**
     * 建立文章
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $title = Arr::get($data, 'title');
        $content = Arr::get($data, 'content');
        $post = $this->post_repository->createPost($title, $content);

        if ($post === null) {
            // TODO DataEmpty
            dd($post);
        }

        return $post;
    }

    public function getPostPaginate(int $limit)
    {
        return $this->post_repository->getPostPaginate($limit);
    }
}
