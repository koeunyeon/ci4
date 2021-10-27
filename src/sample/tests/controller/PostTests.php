<?php


namespace controller;


use App\Models\PostsModel;
use App\Services\PostService;
use CodeIgniter\Test\FeatureTestCase;

class PostTests extends FeatureTestCase // (1)
{
    public function setUp(): void // (2)
    {
        parent::setUp();
        $this->postService = PostService::factory(); // (2)
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }


    public function test_컨트롤러_글_생성_화면()   // (3)
    {
        $result = $this
            ->withSession(['member_id' => 1])  // (4)
            ->get("/post/create");  // (5)

        $result->assertOK();  // (6)
        $result->assertSee("글쓰기");  // (7)

    }

    public function test_컨트롤러_글_생성_로그인페이지_이동() // (8)
    {
        $result = $this->get("/post/create"); // (9)

        // $result->assertRedirect();  // (10)
        $result->assertStatus(302);

    }

    public function test_컨트롤러_글_생성_저장() // (11)
    {
        // given
        $post_data = [ // (12)
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];

        // when
        $result = $this
            ->withSession(['member_id' => 1])
            ->post("/post/create", $post_data);  // (13)

        // then // (14)
        $result->assertOK();
        $result->assertStatus(302);

        // $redirectUrl = $result->getRedirectUrl(); // (15)
        $redirectUrl = $result->response->getHeaderLine('Location');
        $post_id = str_replace("/post/show/", "", $redirectUrl); // (16)

        // (17)
        $postModel = new PostsModel();
        $created_post = $postModel->find($post_id);
        $this->assertNotNull($created_post);
        $this->assertStringContainsString("제목입니다", $created_post->title);
    }

    private function insert_post() // (1)
    {
        $post_data = [
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];
    
        $memberId = 1;
    
        $postService = PostService::factory(); // (2)
        list($result, $post_id, $errors) = $postService->create($post_data, $memberId);
        return [$result, $post_id, $errors];
    }
    
    private function setup_post() // (3)
    {
        list($result, $post_id, $errors) = $this->insert_post();
    
        $postService = PostService::factory();
        return $postService->find($post_id);
    }
    
    public function test_조회() // (4)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
    
        // when
        $result = $this->get("/post/show/$post_id");
    
        // then
        $result->assertOK();
        $result->assertSee("제목입니다.");
        $result->assertDontSee("수정");
    }
    
    public function test_조회_로그인() // (5)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
        $session_data = ['member_id' => 1];
    
        // when
        $result = $this->withSession($session_data)->get("/post/show/$post_id");
    
        // then
        $result->assertOK();
        $result->assertSee("제목입니다.");
        $result->assertSee("수정");
    }
    
    public function test_수정_로그인_안함() // (6)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
    
        // when
        $result = $this->get("/post/edit/$post_id");
    
        // then
        $result->assertOK();
        $result->assertStatus(302);
        $redirectUrl = $result->response->getHeaderLine('Location');
        $result->assertStringContainsString("/post", $redirectUrl);
    }
    
    public function test_수정_로그인_GET() // (7)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
        $session_data = ['member_id' => 1];
    
        // when
        $result = $this->withSession($session_data)->get("/post/edit/$post_id");
    
        // then
        $result->assertOK();
        $result->assertSee("제목입니다.");
    }
    
    public function test_수정_로그인_POST() // (8)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
        $session_data = ['member_id' => 1];
    
        $post_data = [
            'title' => '새로운 제목입니다.',
            'content' => '새로운 본문입니다. 변경될까요?'
        ];
    
        // when
        $result = $this->withSession($session_data)->post("/post/edit/$post_id", $post_data);
    
        // then
        $result->assertOK();
        $result->assertStatus(302);
        $redirectUrl = $result->response->getHeaderLine('Location');
        $this->assertEquals("/post/show/$post_id", $redirectUrl);
    
    
        $postModel = new PostsModel();
        $updated_post = $postModel->find($post_id);
        $this->assertEquals($updated_post->title, $post_data['title']);
    }
    
    public function test_삭제_HTTP_메소드_GET() // (9)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
        $session_data = ['member_id' => 1];
    
        // when
        $result = $this->withSession($session_data)->get("/post/delete");
    
        // then
        $result->assertStatus(302);
    }
    
    public function test_삭제_HTTP_메소드_POST_로그인_안함() // (10)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
    
        // when
        $result = $this->post("/post/delete");
    
        // then
        $result->assertStatus(302);
    }
    
    public function test_삭제_HTTP_메소드_POST_로그인()// (11)
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();
        $session_data = ['member_id' => 1];
        $post_data = ["post_id" => $post_id];
    
        // when
        $result = $this->withSession($session_data)->post("/post/delete", $post_data);
    
        // then
        $result->assertStatus(302);
    
        $postModel = new PostsModel();
        $deleted_post = $postModel->find($post_id);
        $this->assertNull($deleted_post);
    }
    
    public function test_목록() // (12)
    {
        // given
        foreach (range(1, 5) as $item) {
            $this->insert_post();
        }
    
        // when
        $result = $this->get("/post/index"); // (13)
    
        // then
        $result->assertOK();
        $result->assertSee("제목입니다.");
    
        //fwrite(STDERR, print_r($result, TRUE));
    }    
}