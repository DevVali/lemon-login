<?php

namespace App\Controllers;

use Lemon\Http\Request;
use Lemon\Session;
use Lemon\DB;
use Lemon\Validator;
use Lemon\Templating\Template;

class Register
{
	public function get(): Template
	{
		return template("register");
	}

	public function post(Request $request) 
	{
		$request->validate([
			"username" => "notNumeric|min:1|max:15|regex:[a-zA-Z0-9_]*",
			"email" => "max:127|email",
			"password" => "min:8|max:127"
		], template("register"));

		$uid = $request->get("username");
		$email = $request->get("email");

		if ((DB::query("SELECT uid FROM users WHERE uid = ?", $uid)->fetchAll()[0][0] ?? null) === $uid) {
            Validator::addError("user-exists", "username", "");
            return template("register");
		}

		if ((DB::query("SELECT email FROM users WHERE email = ?", $email)->fetchAll()[0][0] ?? null) === $email) {
           	Validator::addError("user-exists", "email", "");
            return template("register");
		}

		$hashedPwd = password_hash($request->get("password"), PASSWORD_DEFAULT);

		DB::query("INSERT INTO users (uid, email, pwd) VALUES (:uid, :email, :pwd)", uid: $uid, email: $email, pwd: $hashedPwd);

		$user = (DB::query("SELECT * FROM users WHERE uid = ?", $uid)->fetchAll()[0] ?? null);

		Session::set("userid", $user["id"]);
		
		Session::set("username", $user["uid"]);

		return redirect("/");
	}
}
