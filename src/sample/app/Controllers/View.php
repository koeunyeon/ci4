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
}