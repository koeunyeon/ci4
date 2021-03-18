<?php


namespace App\Controllers;


class View extends BaseController
{
    public function text(): String
	{
		$age = $this->request->getPost("age") ?? "";
		return View("/view/text", ['age'=>$age]);
	}
}