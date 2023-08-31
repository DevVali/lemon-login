<?php

use App\Middlewares\Auth;
use App\Controllers\Home;
use App\Controllers\Logout;
use App\Controllers\Login;
use App\Controllers\Register;
use Lemon\Route;

Route::collection(function() {
	Route::controller("/", Home::class);

	Route::controller("/logout", Logout::class);
})->middleware([Auth::class, "onlyAuthenticated"]);

Route::collection(function() {
	Route::controller("/login", Login::class);

	Route::controller("/register", Register::class);
})->middleware([Auth::class, "onlyGuest"]);
