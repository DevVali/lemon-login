<?php

namespace App\Controllers;

use Lemon\Http\Request;
use Lemon\Session;
use Lemon\DB;
use Lemon\Validator;
use Lemon\Templating\Template;

class Login
{
	public function get(): Template
	{
		return template("login");
	}

	public function post(Request $request)
	{
		$request->validate([
			"username" => "notNumeric|min:1|max:15|regex:[a-zA-Z0-9_]*",
			"password" => "min:8|max:127"
		], template("login"));

		$uid = $request->get("username");

		$user = (DB::query("SELECT * FROM users WHERE uid = ?", $uid)->fetchAll()[0] ?? null);

		if (!$user || !password_verify($request->get("password"), $user["pwd"])) {
           	Validator::addError("wrong-login", "username or password", "");
            return template("login");
		}

		Session::set("userid", $user["id"]);

		Session::set("username", $user["uid"]);

		return redirect("/");
	}
}
