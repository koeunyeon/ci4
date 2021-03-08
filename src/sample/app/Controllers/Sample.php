<?php


namespace App\Controllers;


class Sample extends BaseController
{
    public function index(): string
    {
        return "Sample Controller";
    }
	
	public function method(): string
	{
		return "run method";
	}
	
	public function param($name): string
	{
		return "param name is " . $name;
	}

	public function param2($name, $age): string
	{
		return "param name is $name. age is $age";
	}
	
	public function defaultparam($name = 'codeigniter 4'): string
	{
		return "default param name is " . $name;
	}
	
	public function showview(): string
	{
		return view("/showView");
	}
	
	public function viewdata(): string
	{
		$data = ['name' => 'ci4', 'age' => 20];
		return view("/viewData.php", $data);
	}
	
	public function postform(): string
	{
		return View("/postForm");
	}	
	
	public function postinput(): void
	{
		$input_data = $this->request->getPost();
		var_export($input_data);
	}
}