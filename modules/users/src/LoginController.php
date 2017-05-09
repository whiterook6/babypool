<?php

namespace Babypool;

use Babypool\BabbyController;
use Babypool\User;
use Illuminate\Http\Request;
use Auth;

class LoginController extends BabbyController {

	public function login_form(){
		return view('login');
	}

	public function login(Request $request){
		$this->validate($request, [
			'email' => 'required|email|exists:users,email',
			'password' => 'required',
			'remember' => 'boolean',
		]);

		$email = $request->input('email');
		$password = $request->input('password');
		$remember = $request->has('remember');

		if (Auth::attempt($email, $password, $remember)){
			$continue = $request->input('continue', '/');
			return redirect($continue);
		} else {
			throw new Exception('Cannot log in with those credentials.');
		}
	}

	public function register(Request $request){
		$this->validate($request, [
			'email' => 'required|email',
			'initials' => 'required|size:2',
			'password' => 'required|confirmed|min:15',
		]);

		$user = User::create([
			'email' => $request->input('email'),
			'initials' => $request->input('initials'),
			'password' => bcrypt($request->input('password')),
		]);

		Auth::login($user);

		return view('registered', [
			'new_user' => $user
		]);
	}

	public function logout(Request $request){
		Auth::logout();

		$continue = $request->input('continue', '/');
		return redirect($continue);
	}
}