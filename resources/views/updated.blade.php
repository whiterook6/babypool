@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Bid Reserved')

@section('content')
			<div class="container">
				<h1>Bid Updated</h1>

				<div class="row">
					<div class="col-12">
						You have updated your bid on {{$date_string}} to ${{$value}} .
						You should receive an email confirmation. There is no need to re-confirm your bid.
					</div>
				</div>
	@include('templates.nav')
			</div>
@endsection