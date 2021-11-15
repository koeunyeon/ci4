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

    private static $postService = null;

    public static function factory()
    {
        if (self::$postService === null) {
            self::$postService = new PostService();
        }

        return self::$postService;
    }
}