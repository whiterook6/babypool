<?php

use Babypool\LoginController;

Route::any('/login', function(){
	return view('login');
});
Route::get('/register', function(){
	return view('new_user');
});

Route::any('/logout', LoginController::class . '@logout');
Route::post('/register', LoginController::class . '@register');