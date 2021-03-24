<?php


namespace App\Controllers;


class View extends BaseController
{
    public function image(): string
	{
		$data = [
			['src' => 'http://codeigniter.com/assets/images/ci-logo-big.png', 'alt' => 'codeigniter4', 'width' => '200px', 'height' => '200px'],
			['src' => base_url('/images/php-logo.svg'), 'alt' => 'PHP', 'width' => '300px', 'height' => '100px'],
		];

		return View("/view/image", ['data' => $data]);
	}
}