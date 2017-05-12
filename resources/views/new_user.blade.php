@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Register')

@section('content')
			<div class="container">
				<h1>Register</h1>

				<form class="form" method="POST">
					<div class="row">
						<div class="col-xs-6">
							<label class="label" for="initials">Initials</label>
							<input class="input" id="initials" name="initials" type="text" maxlength="2" placeholder="TG" />
							<label class="label" for="email">Email Address</label>
							<input class="input" id="email" name="email" type="email" placeholder="example@gmail.com" />
						</div>
						<div class="col-xs-6">
							<label class="label" for="password">Password</label>
							<input class="input" id="password" name="password" type="password" />
							<label class="label" for="password_confirmation">Password Again</label>
							<input class="input" id="password_confirmation" name="password_confirmation" type="password" />
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input class="button inline" type="submit" value="Login" />
						</div>
					</div>
				</form>
			</div>
@endsection
