<?php


namespace App\Controllers;


class View extends BaseController
{
    public function li()
    {
        $alphabet = range(65, 90);
        $alphabet = array_map(
            function ($num) {
                return chr($num);
            }
            , $alphabet);

        return View("/view/li", ['alphabet' => $alphabet]);
    }

    public function checkbox()
    {
        $sports_data = [
            "baseball" => "야구",
            "soccer" => "축구",
            "basketball" => "농구",
        ];

        $sports_like = $this->request->getPost("sports_like") != null;
        $sports_check = $this->request->getPost("sports_name");
        if ($sports_check == null || is_array($sports_check) === false) {
            $sports_check = [];
        }

        return View("/view/checkbox",
            [
                "sports_like" => $sports_like,
                "sports_data" => $sports_data,
                "sports_check" => $sports_check
            ]
        );
    }

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
	
    public function selectoption(): string
    {
        $sports_data = [
            "baseball" => "야구",
            "soccer" => "축구",
            "basketball" => "농구",
        ];

        $selected = $this->request->getPost("sports") ?? "baseball";

        return View("/view/selectoption",
            [
                "sports_data" => $sports_data,
                "selected" => $selected
            ]
        );
    }	
	
    public function text(): string
    {
        $age = $this->request->getPost("age") ?? "";

        return View("/view/text", ['age' => $age]);
    }

    public function pw(): string
    {
        $input_pw = $this->request->getPost("input_pw") ?? "";

        return View("/view/pw", ['input_pw' => $input_pw]);
    }

    public function textarea(): String
	{
		$input = $this->request->getPost("input") ?? "";

		return View("/view/textarea", ['input'=>$input]);
	}
}