<?php


namespace App\Controllers;


class View extends BaseController
{
	public function link(): string
	{
		$link_data = [
			['url' => 'https://koeunyeon.github.io', 'message' => '고은연 github', 'is_new_tab' => true],
			['url' => 'https://github.com', 'message' => '깃헙', 'is_new_tab' => false],
			['url' => 'https://velog.io/@koeunyeon', 'message' => '고은연 블로그', 'is_new_tab' => true],        
			['url' => 'http://ci4doc.cikorea.net/', 'message' => '코드이그나이터4 한글 메뉴얼', 'is_new_tab' => true]
		];

		return View("/view/link", ['link_data' => $link_data]);
	}
    
}