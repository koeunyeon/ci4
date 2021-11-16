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
        return $postModel->find($post_id);
    }

    public function isAuthor($post, $member_id){
        return $post->isAuthor($member_id);
    }

    public function update($post, $new_post_data)
    {
        $post->fill($new_post_data);
        $postModel = new PostsModel();
        $isSuccess = $postModel->save($post);
        return [$isSuccess, $postModel->errors()];
    }

    public function delete($post_id, $member_id)
    {        
        $post = $this->find($post_id);

        if (!$post) {
            return false;
        }

        if ($this->isAuthor($post, $member_id) === false) {
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
        $post_list = $model->paginate(10, "default", $page);
        $pager = $post_query->pager;

        return [$pager, $post_list];
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