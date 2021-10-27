<?php


namespace controller;


use App\Models\PostsModel;
use CodeIgniter\Test\FeatureTestCase;

class PostTests extends FeatureTestCase // (1)
{
    public function setUp(): void // (2)
    {
        parent::setUp();
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
        $this->assertStringContainsString("제목입니다", $created_post['title']); // (18)
    }
}