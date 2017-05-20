<?php

use Babypool\LoginController;
use Babypool\UserController;

Route::get('/login', function(){
	return view('login');
});
Route::get('/register', function(){
	return view('new_user');
});

Route::post('/login', LoginController::class . '@login');
Route::any('/logout', LoginController::class . '@logout');
Route::post('/register', LoginController::class . '@register');
Route::get('/me', UserController::class . '@me');

Route::group([
	'prefix' => 'users',
	'middleware' => 'auth'
], function () {
	Route::get('/me', UserController::class . '@me');
});