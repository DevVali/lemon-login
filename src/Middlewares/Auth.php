<?php

namespace App\Middlewares;

use Lemon\Session;

class Auth
{
	public function onlyAuthenticated()
	{
		if (!Session::has("userid")) {
			return error(404);
		}
	}

	public function onlyGuest()
	{
		if (Session::has("userid")) {
			return redirect("/");
		}
	}
}
