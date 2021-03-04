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
}