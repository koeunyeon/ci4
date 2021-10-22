<?php
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\PostsModel;

class Post extends Controller
{
    // 생성
    public function create()
	{
		if ($this->request->getMethod() === "get") {
			return view("/post/create");
		}
		
		$model = new PostsModel();
		$post_id = $model->insert($this->request->getPost());
		if ($post_id) {
			$this->response->redirect("/post/show/$post_id");
		} else {
			return view("/post/create", [
				'post_data' => $this->request->getPost(),
				'errors' => $model->errors()
			]);
		}
	}

    // 조회
    public function show($post_id){
		$model = new PostsModel();
		$post = $model->find($post_id);
		if (!$post) {
			return $this->response->redirect("/post");
		}

		return view('/post/show',[
			'post' => $post
		]);
    }   

    // 수정
    public function edit($post_id)
	{
		$model = new PostsModel();
		$post = $model->find($post_id);
		if (!$post) {
			return $this->response->redirect("/post");
		}

		if ($this->request->getMethod() === "get") {
			return view("/post/create",[
				'post_data' => $post
			]);
		}

		$model->update($post_id, $this->request->getPost());

		$this->response->redirect("/post/show/$post_id");
	}

    // 삭제
public function delete()
	{
		if ($this->request->getMethod() !== "post"){
			return $this->response->redirect("/post");
		}

		$post_id = $this->request->getPost('post_id');
		$model = new PostsModel();
		$post = $model->find($post_id);
		if (!$post) {
			return $this->response->redirect("/post");
		}

		$model->delete($post_id);
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
			'pager' => $pager
		]);
    }

}