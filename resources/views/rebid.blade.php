@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Rebid Successful')

@section('content')
			<div class="container">
				<h1>Rebid Successful</h1>

				<div class="row">
					<div class="col-12">
						You have increased your bid on {{$date_string}} to ${{$bid->value}}.
					</div>
				</div>
	@include('templates.nav')
			</div>
@endsection