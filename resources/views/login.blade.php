@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Login')

@section('content')
			<div class="container">
				<h1>Login</h1>
				<form class="form" method="POST" action="/bids/{{$date}}">
					<div class="row">
						<div class="col-xs-6">
							<label class="label" for="email">Email Address</label>
							<input class="input" id="email" name="email" type="email" placeholder="example@gmail.com" />
						</div>
						<div class="col-xs-6">
							<label class="label" for="password">Password</label>
							<input class="input" id="password" name="password" type="password" />
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<input class="button inline" type="submit" value="Login" />
						</div>
					</div>
				</form>

				<div class="row">
					<div class="col-12 form">
						<a class="button inline"
							href="/calendar">Calendar</a>
						<a class="button inline"
							href="/rules">Rules</a>
					</div>
				</div>
			</div>
@endsection
