<?php

namespace service;

use App\Services\PostService;
use CodeIgniter\Test\CIDatabaseTestCase;

class PostTests extends CIDatabaseTestCase
{
    public function setUp() :void
    {
        parent::setUp();
        $this->postService = PostService::factory();
    }

    public function tearDown() :void
    {
        parent::tearDown();
    }

    public function test_글생성_성공(){
        // given
        $post_data = [
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];

        $memberId = 1;

        // when
        list($result, $post_id, $errors) = PostService::factory()->create($post_data, $memberId);

        // then
        $this->assertTrue($result);
        $this->assertNotNull($post_id);
        $this->assertCount(0, $errors);
    }

    public function test_글생성_유효성검사()
    {
        // given
        $post_data = [
            'title' => '',
            'content' => ''
        ];

        $memberId = 1;

        // when
        list($result, $post_id, $errors) = PostService::factory()->create($post_data, $memberId);

        $this->assertFalse($result);
        $this->assertNull($post_id);

        fwrite(STDERR, print_r($errors, TRUE));
    }

    private function insert_post()
    {
        $post_data = [
            'title' => '제목입니다.',
            'content' => '본문은 10글자 이상이죠?'
        ];

        $memberId = 1;

        list($result, $post_id, $errors) = $this->postService->create($post_data, $memberId);
        return [$result, $post_id, $errors];
    }

    public function test_글_조회()
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();

        // when
        $post_success = $this->postService->find($post_id);
        $post_fail = $this->postService->find(-1);

        // then
        $this->assertNotNull($post_success);
        $this->assertNull($post_fail);
    }

    private function setup_post(){
        list($result, $post_id, $errors) = $this->insert_post();
        return $this->postService->find($post_id);
    }

    public function test_작성자_확인()
    {
        // given
        $post = $this->setup_post();

        // when
        $author_true = $post->isAuthor(1);
        $author_false = $post->isAuthor(-1);

        // then
        $this->assertTrue($author_true);
        $this->assertNotTrue($author_false);
    }

    public function test_수정()
    {
        // given
        $post = $this->setup_post();
        $new_post_data = ['title'=> '새로운 제목이에요'];

        // when
        list($updateSuccess, $errors) = $this->postService->update($post, $new_post_data);

        // then
        $this->assertTrue($updateSuccess);

        $updated_title = $this->postService->find($post->post_id)->title;
        $this->assertEquals($new_post_data['title'], $updated_title);
    }

    public function test_삭제()
    {
        // given
        list($result, $post_id, $errors) = $this->insert_post();

        // when
        $not_deleted = $this->postService->delete($post_id, -1);
        $deleted = $this->postService->delete($post_id, 1);

        // then
        $this->assertNotTrue($not_deleted);
        $this->assertTrue($deleted);
    }

    public function test_목록()
    {
        // given
        foreach (range(1,5) as $item) {
            $this->insert_post();
        }

        // when
        list($pager, $post_list) = $this->postService->post_list(1);

        // then
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

        // when
        list($pager, $post_list) = $this->postService->post_list(2);

        // then
        $this->assertCount(0, $post_list);
    }    
}
