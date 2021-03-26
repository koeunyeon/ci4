<?php


namespace App\Controllers;


class View extends BaseController
{
    public function layout()
	{
		$hello = "안녕하세요";
		return view("/view/layout_content.php", [
			'hello' => $hello
		]);
	}
}