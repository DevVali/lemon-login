<?php

namespace App\Controllers;

use Lemon\Session;

class Logout
{
	public function get()
	{
		Session::clear();
		return redirect("/login");
	}
}
