@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', $date_string)

@section('content')
			<div class="container">
				<h1>
@isset($previous_date)
					<div class="left form">
						<a class="button"
							href="{{$previous_date}}"><span class="fa fa-chevron-left"></span> Previous Day</a>
					</div>
@endisset
					{{$date_string}}
@isset($next_date)
					<div class="right form">
						<a class="button"
							href="{{$next_date}}">Next Day <span class="fa fa-chevron-right"></span></a>
					</div>
@endisset
				</h1>
				<div class="row">
					<div class="col-sm-4">

@if($current_bid)
						<h2>Current Bid: <small>${{$current_bid['value']}}</small></h2>
						<div class="bids">
							<div class="bid">
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
								<span class="email">{{$previous_bid['bidder']['email']}}</span>
								<span class="value">${{$previous_bid['value']}}</span>
							</div>
	@endforeach
						</div>
@else
						No prevous bids.
@endif
					</div>
					<div class="col-sm-8">
						<h2>To Raise: <small>${{$next_value}}</small></h2>
						<form class="form" method="POST" action="/bids/{{$date}}">
							<div class="row">
								<div class="col-xs-6">
									<label class="label" for="email">Email Address</label>
									<input class="input" id="email" name="email" type="email" placeholder="example@gmail.com" />
								</div>
								<div class="col-xs-6">
									<label class="label" for="value">Bid in Dollars</label>
									<input class="input" id="value" name="value" value="{{$next_value}}" type="number" placeholder="{{$next_value}}" />
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
						<a class="button inline"
							href="/calendar">Calendar</a>
						<a class="button inline"
							href="/rules">Rules</a>
					</div>
				</div>
			</div>
@endsection
