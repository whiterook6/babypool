<?php

namespace Babypool;

use Babypool\BabbyController;
use Babypool\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends BabbyController {

	public function login(Request $request){
		$this->validate($request, [
			'email' => 'required|email|exists:users,email',
			'password' => 'required',
			'remember' => 'boolean',
		]);

		$email = $request->input('email');
		$password = $request->input('password');
		$remember = $request->has('remember');
		$continue = $request->input('continue', '/calendar');

		if (Auth::attempt([
			'email' => $email,
			'password' => $password
		], $remember)){
			return redirect($continue);
		} else {
			return view('login', [
				'exception' => new \Exception('Invalid login')
			]);
		}
	}

	public function register(Request $request){
		$this->validate($request, [
			'email' => 'required|email|unique:users,email',
			'initials' => 'required|size:2|unique:users,initials',
			'password' => 'required|confirmed|min:8'
		]);

		$user = User::create([
			'email' => $request->input('email'),
			'enable_notifications' => $request->has('enable_notifications'),
			'initials' => $request->input('initials'),
			'password' => bcrypt($request->input('password')),
		]);

		Auth::login($user);
		$continue = $request->input('continue', '/calendar');

		return redirect($continue);
	}

	public function logout(Request $request){
		Auth::logout();

		$continue = $request->input('continue', '/calendar');
		return redirect($continue);
	}
}