<?php


namespace App\Controllers;


class View extends BaseController
{
    public function textarea(): String
	{
		$input = $this->request->getPost("input") ?? "";

		return View("/view/textarea", ['input'=>$input]);
	}
}