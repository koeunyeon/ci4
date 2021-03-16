<?php


namespace App\Controllers;


class View extends BaseController
{
    public function radio()
	{
		$sports_data = [
			"baseball" => "야구",
			"soccer" => "축구",
			"basketball" => "농구",
		];

		$checked = $this->request->getPost("sports") ?? "baseball";

		return View("/view/radio",
			[
				"sports_data" => $sports_data,
				"checked" => $checked
			]
		);
	}
}