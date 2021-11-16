<?php

namespace App\Services;

use App\Entities\PostEntity;
use App\Models\PostsModel;

class PostService
{
    public function create($post_data, $memberId)
    {
        $postEntity = new PostEntity();
        $postEntity->fill($post_data);
        $postEntity->author = $memberId;

        $postModel = new PostsModel();
        $post_id = $postModel->insert($postEntity);

        if ($post_id) {
            return [true, $post_id, []];
        }

        return [false, null, $postModel->errors()];
    }

    public function find($post_id){
        $postModel = new PostsModel();
        return $postModel->asObject("App\Entities\PostEntity")->find($post_id);
    }

    public function isAuthor($post, $member_id){
        return $post->isAuthor($member_id);
    }

    private static $postService = null;

    public static function factory()
    {
        if (self::$postService === null) {
            self::$postService = new PostService();
        }

        return self::$postService;
    }
}