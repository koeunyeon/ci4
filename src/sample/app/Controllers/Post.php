<?php
namespace App\Controllers;

use App\Entities\PostEntity;
use App\helpers\LoginHelper;
use CodeIgniter\Controller;

use App\Models\PostsModel;
use App\Services\PostService;


class Post extends Controller
{
    // 생성
	public function create()
	{
		if (LoginHelper::isLogin() === false) {
			return $this->response->redirect("/post");
		}
	
		if ($this->request->getMethod() === "get") {
			return view("/post/create");
		}
	
		list($create_success, $post_id, $errors) =
			PostService::factory()
			->create(
				$this->request->getPost(),
				LoginHelper::memberId()
			);
		if ($create_success){
			return $this->response->redirect("/post/show/$post_id");
		}

		$postEntity = new PostEntity();
		$postEntity->fill($this->request->getPost());
		return view("/post/create", [
			'post_data' => $postEntity,
			'errors' => $errors
		]);
	}

	// 조회
	public function show($post_id)
	{
		$postService = PostService::factory(); // (1)
		$post = $postService->find($post_id); // (2)
		if (!$post) {
			return $this->response->redirect("/post");
		}

		$isAuthor = $postService->isAuthor($post, LoginHelper::memberId()); // (3)

		return view('/post/show',[
			'post' => $post,
			'isAuthor' => $isAuthor
		]);
	}

    // 수정
    public function edit($post_id)
	{
		if (LoginHelper::isLogin() === false) {
			return $this->response->redirect("/post");
		}

		$postService = PostService::factory();
		$post = $postService->find($post_id);
		if (!$post) {
			return $this->response->redirect("/post");
		}

		if ($postService->isAuthor($post, LoginHelper::memberId()) === false){
			return $this->response->redirect("/post");
		}

		if ($this->request->getMethod() === "get") {
			return view("/post/create",[
				'post_data' => $post
			]);
		}

		list($isSuccess, $errors) = $postService->update($post, $this->request->getPost());
		if ($isSuccess){
			$this->response->redirect("/post/show/$post_id");
		}else{
			return view("/post/create",[
				'post_data' => $post,
				'errors' => $errors
			]);
		}
	}

    // 삭제
	public function delete()
	{
		if (LoginHelper::isLogin() === false) { // (1)
			return $this->response->redirect("/post");
		}
	
		if ($this->request->getMethod() !== "post"){
			return $this->response->redirect("/post");
		}
	
		$post_id = $this->request->getPost('post_id');
		PostService::factory()->delete($post_id, LoginHelper::memberId());
		return $this->response->redirect("/post");
	}

    // 목록
    public function index($page=1){
		$model = new PostsModel();
		$post_query = $model->orderBy("created_at", "desc");
		$post_list = $model->paginate(10); // (1)
		$pager = $post_query->pager;
		$pager->setPath("/post");
	
		return view("post/index", [
			'post_list' => $post_list,
			'pager' => $pager,
			'isLogin' => LoginHelper::isLogin()
		]);
    }

}