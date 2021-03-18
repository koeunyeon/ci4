<?php


namespace App\Controllers;


class View extends BaseController
{
    public function pw(): String
	{
		$input_pw = $this->request->getPost("input_pw") ?? "";

		return View("/view/pw", ['input_pw'=>$input_pw]);
	}
}