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

		return View("/view/li", ['alphabet'=>$alphabet]);
	}
    
}