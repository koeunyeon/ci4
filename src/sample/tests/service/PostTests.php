<?php

namespace service;

use App\Services\PostService;
use CodeIgniter\Test\CIDatabaseTestCase; // (1)

class PostTests extends CIDatabaseTestCase // (2)
{
    public function setUp() :void // (3)
    {
        parent::setUp(); // (4)
    }

    public function tearDown() :void // (5)
    {
        parent::tearDown(); // (6)
    }

    public function test_글생성_성공(){ // (7)
        // given // (8)
        $post_data = [ // (9)
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];

        $memberId = 1; // (10)

        // when // (11)
        list($result, $post_id, $errors) = PostService::factory()->create($post_data, $memberId); // (12)

        // then // (13)
        $this->assertTrue($result); // (14)
        $this->assertNotNull($post_id); // (15)
        $this->assertCount(0, $errors); // (16)
    }

    public function test_글생성_유효성검사()
    {
        // given
        $post_data = [ // (1)
            'title' => '',
            'content' => ''
        ];

        $memberId = 1;

        // when
        list($result, $post_id, $errors) = PostService::factory()->create($post_data, $memberId);

        $this->assertFalse($result);
        $this->assertNull($post_id);

        fwrite(STDERR, print_r($errors, TRUE)); // (2)
    }

    private function insert_post() // (3)
    {
        $post_data = [
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];

        $memberId = 1;

        list($result, $post_id, $errors) = $this->postService->create($post_data, $memberId); // (4)
        return [$result, $post_id, $errors];
    }

    public function test_글_조회()
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();

        // when
        $post_success = $this->postService->find($post_id);
        $post_fail = $this->postService->find(-1);

        // then  // (5)
        $this->assertNotNull($post_success);
        $this->assertNull($post_fail);
    }

    private function setup_post(){ // (6)
        list($result, $post_id, $errors) = $this->insert_post();
        return $this->postService->find($post_id);
    }

    public function test_작성자_확인()
    {
        // given
        $post = $this->setup_post();

        // when  // (7)
        $author_true = $post->isAuthor(1);
        $author_false = $post->isAuthor(-1);

        // then  // (8)
        $this->assertTrue($author_true);
        $this->assertNotTrue($author_false);
    }

    public function test_수정()
    {
        // given
        $post = $this->setup_post();
        $new_post_data = ['title'=> '새로운 제목이에요'];

        // when  // (9)
        list($updateSuccess, $errors) = $this->postService->update($post, $new_post_data);

        // then  // (10)
        $this->assertTrue($updateSuccess);

        $updated_title = $this->postService->find($post->post_id)->title;
        $this->assertEquals($new_post_data['title'], $updated_title);
    }

    public function test_삭제()
    {
        // given   // (11)
        list($result, $post_id, $errors) = $this->insert_post();

        // when   // (12)
        $not_deleted = $this->postService->delete($post_id, -1);
        $deleted = $this->postService->delete($post_id, 1);

        // then   // (13)
        $this->assertNotTrue($not_deleted);
        $this->assertTrue($deleted);
    }

    public function test_목록()
    {
        // given
        foreach (range(1,5) as $item) { // (14)
            $this->insert_post();
        }

        // when // (15)
        list($pager, $post_list) = $this->postService->post_list(1);

        // then // (16)
        $this->assertNotNull($pager);
        $this->assertNotNull($post_list);
        $this->assertCount(5, $post_list);
    }

    public function test_목록_2페이지()
    {
        // given
        foreach (range(1,5) as $item) {
            $this->insert_post();
        }

        // when // (17)
        list($pager, $post_list) = $this->postService->post_list(2);

        // then // (18)
        $this->assertCount(0, $post_list);
    }    
}
