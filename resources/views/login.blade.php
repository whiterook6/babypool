@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Login')

@section('content')
			<div class="container">
				<h1>Login</h1>
	@isset($exception)
				<div class="row form">
					<div class="col-sm-4 offset-sm-4">
						<span class="text">
							<span class="fa fa-exclamation-triangle"></span>
							{{$exception->getMessage()}}
						</span>
					</div>
				</div>
	@endisset
				<form class="form" method="POST">
					<div class="row">
						<div class="col-sm-4 offset-sm-4">
							<label class="label" for="email">Email Address</label>
							<input class="input" id="email" name="email" type="email" placeholder="example@gmail.com" />
							<label class="label" for="password">Password</label>
							<input class="input" id="password" name="password" type="password" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-4">
							<input class="button block" type="submit" value="Login" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 offset-sm-4">
							<span class="text">
								Or <a href="/register">register</a>.
							</span>
						</div>
					</div>
				</form>
				<div class="row form">
					<div class="col-12">
						<a class="button inline"
							href="/calendar">Calendar</a>
						<a class="button inline"
							href="/rules">Rules</a>
						</div>
					</div>
				</div>
			</div>
@endsection
