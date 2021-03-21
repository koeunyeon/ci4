<?php


namespace App\Controllers;


class View extends BaseController
{
    public function table(): string
	{
		$table_data = [
			["name" => "코드이그나이터", "age" => 10, "gender" => "male"],
			["name" => "라라벨", "age" => 25, "gender" => "female"],
			["name" => "스프링", "age" => 76, "gender" => "unknown"],
		];

		return View("/view/table", ['table_data' => $table_data]);
	}
}