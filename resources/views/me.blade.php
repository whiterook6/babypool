@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Me')

@section('content')
			<div class="container">
				<h1>Currently Logged In: {{$user['initials']}}</h1>

				<div class="row">
					<div class="col-sm-4">
						<h2>Bids</h2>
	@if (!empty($user['bids']))
		@foreach ($user['bids'] as $bid)
						<div>
							{{$bid['date']}}: ${{$bid['value']}}
			@if ($bid['paid'] < $bid['value'])
							(Only ${{$bid['paid']}} paid.)
			@endif
						</div>
		@endforeach
	@else
						<div>No bids.</div>
	@endif
					</div>
					<div class="col-sm-4">
						<h2>Total Bid</h2>
						${{$total_bid}}

						<h2>Total Paid</h2>
						${{$total_paid}}
						(${{$total_owing}} owing.)
					</div>
				</div>
			</div>
@endsection
