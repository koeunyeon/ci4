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
}