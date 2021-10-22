<?php
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\PostsModel;

use Michelf\Markdown;

class Post extends Controller
{
	// $content가 있다면 마크다운으로 변환한 데이터도 함께 배열에 담는다.
	private function add_input_markdown(){		
		$data = $this->request->getPost();
		if (array_key_exists("content", $data)){
			$content = $data['content'];
			$content = str_replace(PHP_EOL, "  " . PHP_EOL, $content);
			$data['html_content'] = Markdown ::defaultTransform($content);
		}

		return $data;
	}

    // 생성
    public function create()
	{
		if ($this->request->getMethod() === "get") {
			return view("/post/create");
		}
		
		$model = new PostsModel();		
		// $post_id = $model->insert($this->request->getPost());
		$data = $this->add_input_markdown();
		$post_id = $model->insert($data);
		if ($post_id) {  // 모델에서 유효성 검사를 통과할 경우
			$this->response->redirect("/post/show/$post_id");
		} else { // 모델에서 유효성 검사가 실패하는 경우
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

		// $isSuccess = $model->update($post_id, $this->request->getPost());
		$data = $this->add_input_markdown();
		$isSuccess = $model->update($post_id, $data);
		
		if ($isSuccess){
			$this->response->redirect("/post/show/$post_id");
		}else{
			return view("/post/create", [
				'post_data' => $this->request->getPost(),
				'errors' => $model->errors()
			]);
		}
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