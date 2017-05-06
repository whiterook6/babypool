@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', $exception->getMessage())

@section('content')

<div class="container">
	<div class="row">
		<div class="col-12">
			<span class="fa fa-exclamation-triangle"></span>
			{{$exception->getMessage()}}
		</div>
	</div>
</div>

@endsection