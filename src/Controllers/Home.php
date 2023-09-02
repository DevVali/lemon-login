<?php

namespace App\Controllers;

use Lemon\Http\Session;
use Lemon\Templating\Template;

class Home
{
	public function get(Session $session): Template
	{
		return template("home", session: $session);
	}
}
