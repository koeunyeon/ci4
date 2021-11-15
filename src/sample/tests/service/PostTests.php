<?php

namespace service;

use App\Services\PostService;
use CodeIgniter\Test\CIDatabaseTestCase;

class PostTests extends CIDatabaseTestCase
{
    public function setUp() :void
    {
        parent::setUp();
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
        list($result, $post_id, $errors) = PostService::factory()->create($post_data, $memberId); // (12)

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
}
