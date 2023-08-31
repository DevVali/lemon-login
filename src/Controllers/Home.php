<?php

namespace App\Controllers;

use Lemon\Templating\Template;

class Home
{
	public function get(): Template
	{
		return template("home");
	}
}
