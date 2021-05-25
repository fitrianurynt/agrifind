<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if (isset($_SESSION['id'])) {
			return redirect()->to("/profile");
		} else {
			$data = [
				'title' => 'Home | Agrifind'
			];

			return view('/home/index', $data);
		}
	}
}
