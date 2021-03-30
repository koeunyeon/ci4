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

    public function table(): string
	{
		$table_data = [
			["name" => "코드이그나이터", "age" => 10, "gender" => "male"],
			["name" => "라라벨", "age" => 25, "gender" => "female"],
			["name" => "스프링", "age" => 76, "gender" => "unknown"],
		];

		return View("/view/table", ['table_data' => $table_data]);
	}

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