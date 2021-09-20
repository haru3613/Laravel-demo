<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
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

            $post = new Post();
            $post->title = $title;
            $post->content = $content;
            $post->user_id = $user->id;
            $post->save();

            return $post;
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * 取得文章數量
     *
     * @param integer $limit 數量
     * @return mixed
     */
    public function getPostPaginate(int $limit)
    {

        try {
            // $user = Auth::guard('api')->user();
            // $result = User::find($user->id);
            // dd($result->posts);
            $user = Auth::guard('api')->user();

            return Post::where('user_id', $user->id)->paginate($limit);
        } catch (Exception $e) {
            dd($e);
        }
    }
}
