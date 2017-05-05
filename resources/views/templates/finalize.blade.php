@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', $result)

@section('content')
			<div class="container">
				<h1>{{$result_title}}</h1>

				<div class="row">
					<div class="col-12">
						You have {{$result}} your bid of ${{$value}} on {{$date_string}}.
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