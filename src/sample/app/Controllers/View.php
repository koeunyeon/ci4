<?php


namespace App\Controllers;


use phpDocumentor\Reflection\Types\String_;

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

    public function hidden(): string
    {
        $input = $this->request->getPost("input") ?? "";

        return View("/view/hidden", ['input' => $input]);
    }

    public function textarea(): string
    {
        $input = $this->request->getPost("input") ?? "";

        return View("/view/textarea", ['input' => $input]);
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
            ['url' => 'https://koeunyeon.github.io', 'message' => '고은연 블로그', 'is_new_tab' => true],
            ['url' => 'https://github.com', 'message' => '깃헙', 'is_new_tab' => false],
            ['url' => 'http://ci4doc.cikorea.net/', 'message' => '코드이그나이터4 한글 메뉴얼', 'is_new_tab' => true]
        ];

        return View("/view/link", ['link_data' => $link_data]);
    }

    public function image(): string
    {
        $data = [
            ['src' => 'http://codeigniter.com/assets/images/ci-logo-big.png', 'alt' => 'codeigniter4', 'width' => '200px', 'height' => '200px'],
            ['src' => base_url('/images/php-logo.svg'), 'alt' => 'PHP', 'width' => '300px', 'height' => '100px'],
        ];

        return View("/view/image", ['data' => $data]);
    }

    private function file_upload($file)
    {

    }

    public function upload(): string
    {
        $file = $this->request->getFile("single_file");

        $fileInfo = [];
        if ($file != null) {
            if (!$file->isValid()) {
                $errorString = $file->getErrorString();
                $errorCode = $file->getError();
                $fileInfo['hasError'] = true;
                $fileInfo['errorString'] = $errorString;
                $fileInfo['errorCode'] = $errorCode;

            } else {
                $fileInfo['hasError'] = false;
                if ($file->hasMoved() === false) {
                    // mimeType은 `store` 전에.
                    $fileInfo['mimeType'] = $file->getMimeType();

                    $savedPath = $file->store();

                    $fileInfo['savedPath'] = $savedPath;
                    $fileInfo['clientName'] = $file->getClientName();
                    $fileInfo['name'] = $file->getName();
                    $fileInfo['clientMimeType'] = $file->getClientMimeType();
                    $fileInfo['clientExtention'] = $file->getClientExtension();
                    $fileInfo['guessExtention'] = $file->guessExtension();
                }
            }
        }

        return View("/view/upload", [
            'fileInfo' => $fileInfo
        ]);
    }

    public function upload_multi(): string
    {
        $files = $this->request->getFileMultiple("files");

        if ($files == null) {
            return View("/view/upload_multi", [
                'file_info_array' => []
            ]);
        }

        $file_info_array = [];

        foreach ($files as $file) {
            $fileInfo = [];
            if ($file != null) {
                if (!$file->isValid()) {
                    $errorString = $file->getErrorString();
                    $errorCode = $file->getError();
                    $fileInfo['hasError'] = true;
                    $fileInfo['errorString'] = $errorString;
                    $fileInfo['errorCode'] = $errorCode;

                } else {
                    $fileInfo['hasError'] = false;
                    if ($file->hasMoved() === false) {
                        // mimeType은 `store` 전에.
                        $fileInfo['mimeType'] = $file->getMimeType();

                        $savedPath = $file->store();

                        $fileInfo['savedPath'] = $savedPath;
                        $fileInfo['clientName'] = $file->getClientName();
                        $fileInfo['name'] = $file->getName();
                        $fileInfo['clientMimeType'] = $file->getClientMimeType();
                        $fileInfo['clientExtention'] = $file->getClientExtension();
                        $fileInfo['guessExtention'] = $file->guessExtension();
                    }
                }
            }

            array_push($file_info_array, $fileInfo);
        }

        return View("/view/upload_multi", [
            'file_info_array' => $file_info_array
        ]);
    }

    public function viewif()
    {
        $now = time();
        $is_even = $now % 2;
        return View("/view/viewif", [
            'now' => $now,
            'is_even' => $is_even,
        ]);
    }

    public function layout()
    {
        $hello = "안녕하세요";
        return view("/view/layout_content.php", [
            'hello' => $hello
        ]);
    }
}