@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Registered')

@section('content')
			<div class="container">
				<h1>Registered</h1>

				<div class="row">
					<div class="col-12">
						You are now registered. You've also been logged in.
					</div>
				</div>

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