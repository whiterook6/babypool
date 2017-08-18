@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Bid Reserved')

@section('content')
			<div class="container">
				<h1>Bid Reserved</h1>

				<div class="row">
					<div class="col-12">
						You have reserved your bid of ${{$value}} on {{$date_string}}.
					</div>
				</div>
	@include('templates.nav')
			</div>
@endsection