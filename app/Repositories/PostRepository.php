<?php

namespace App\Repositories;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Auth;

class PostRepository
{
    /**
     * 建立文章
     *
     * @param string $title 標題
     * @param string $content 內文
     * @return mixed
     */
    public function createPost(string $title, string $content)
    {

        try {
            $user = Auth::guard('api')->user();
            dd($user);
            $post = new Post();
            $post->title = $title;
            $post->content = $content;
            $post->user_id = $user->id;

            return $post;
        } catch (Exception $e) {
            dd($e);
        }
    }
}
