@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', $date_string)

@section('content')
			<div class="container">
				<h1>
					{{$date_string}}
				</h1>
				<div class="row">
					<div class="col-sm-4">

@if($current_bid)
						<h2>Current Bid: <small>${{$current_bid['value']}}</small></h2>
						<div class="bids">
							<div class="bid">
	@if($current_bid['status'] == 'paid')
								<span class="fa fa-money"></span>
	@elseif($current_bid['status'] == 'confirmed')
								<span class="fa fa-check"></span>
	@elseif($current_bid['status'] == 'unconfirmed')
								<span class="fa fa-clock-o"></span>
	@endif
								<span class="email">{{$current_bid['bidder']['email']}}</span>
								<span class="value">${{$current_bid['value']}}</span>
							</div>
						</div>
@endif


						<h2>Previous Bids</h2>
@if($previous_bids && count($previous_bids) > 0)
						<div class="bids">
	@foreach($previous_bids as $previous_bid)
							<div class="bid disabled">

		@if($previous_bid['status'] == 'paid')
								<span class="fa fa-money"></span>
		@elseif($previous_bid['status'] == 'confirmed')
								<span class="fa fa-check"></span>
		@elseif($previous_bid['status'] == 'unconfirmed')
								<span class="fa fa-clock-o"></span>
		@endif
								<span class="email">{{$previous_bid['bidder']['email']}}</span>
								<span class="value">${{$previous_bid['value']}}</span>
							</div>
	@endforeach
						</div>
@elseif
						No prevous bids.
@endif
					</div>
					<div class="col-sm-8">
						<h2>To Raise: <small>${{$next_value}}</small></h2>
						<form class="form">
							<div class="row">
								<div class="col-xs-6">
									<label class="label" for="email">Email Address</label>
									<input class="input" id="email" type="email" placeholder="example@gmail.com" />
								</div>
								<div class="col-xs-6">
									<label class="label" for="bid">Bid in Dollars</label>
									<input class="input" id="bid" type="number" placeholder="{{$next_value}}" />
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<input class="button inline" type="submit" value="Place Bid" />
								</div>
							</div>
						</form>

						<p>After clicking Place Bid, check your email. Your bid is reserved for 10 minutes.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form">
						<button class="button">Back</button>
					</div>
				</div>					
			</div>
@endsection
