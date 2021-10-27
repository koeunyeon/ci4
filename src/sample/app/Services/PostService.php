<?php

namespace App\Services;

use App\Entities\PostEntity;
use App\Models\PostsModel;

class PostService  // (1)
{
    public function create($post_data, $memberId)  // (2)
    {
        $postEntity = new PostEntity(); // (3)
        $postEntity->fill($post_data); // (4)
        $postEntity->author = $memberId; // (5)

        $postModel = new PostsModel(); // (6)
        $post_id = $postModel->insert($postEntity); // (7)

        if ($post_id) {
            return [true, $post_id, []]; // (8)
        }

        return [false, null, $postModel->errors()]; // (9)
    }

    public function find($post_id){
        $postModel = new PostsModel();
        return $postModel->asObject("App\Entities\PostEntity")->find($post_id); // (1)
    }

    public function isAuthor($post, $member_id){ // (1)
        return $post->isAuthor($member_id);
    }

    private static $postService = null; // (10)

    public static function factory() // (11)
    {
        if (self::$postService === null) { // (12)
            self::$postService = new PostService();
        }

        return self::$postService; // (13)
    }
}