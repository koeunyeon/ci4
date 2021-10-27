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
        return $postModel->find($post_id); // (1)
    }

    public function isAuthor($post, $member_id){ // (1)
        return $post->isAuthor($member_id);
    }

    public function update($post, $new_post_data)
    {
        $post->fill($new_post_data); // (1)
        $postModel = new PostsModel();
        $isSuccess = $postModel->save($post); // (2)
        return [$isSuccess, $postModel->errors()];
    }

    public function delete($post_id, $member_id)
    {        
        $post = $this->find($post_id);

        if (!$post) {
            return false;
        }

        if ($this->isAuthor($post, $member_id) === false) { // (1) 
            return false;
        }

        $postModel = new PostsModel();
        $postModel->delete($post->post_id);

        return true;
    }

    public function post_list($page)
    {
        $model = new PostsModel();
        $post_query = $model->orderBy("created_at", "desc");
        $post_list = $model->paginate(10, "default", $page); // (1)
        $pager = $post_query->pager;

        return [$pager, $post_list];
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