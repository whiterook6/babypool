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
								<span class="email">{{$current_bid['user']['initials']}}</span>:
								<span class="value">${{$current_bid['value']}}</span>
							</div>
						</div>
@endif


						<h2>Previous Bids</h2>
@if($previous_bids && count($previous_bids) > 0)
						<div class="bids">
	@foreach($previous_bids as $previous_bid)
							<div class="bid disabled">
								<span class="email">{{$previous_bid['user']['initials']}}</span>:
								<span class="value">${{$previous_bid['value']}}</span>
							</div>
	@endforeach
						</div>
@else
						No prevous bids.
@endif
					</div>
					<div class="col-sm-4">
@if ($can_bid)
						<h2>To Raise: <small>${{$next_value}}</small></h2>
	@if (!isset($current_bid) || $current_bid['user_id'] != Auth::id())
						<form class="form" method="POST" action="/bids/{{$date}}">
							<div class="row">
								<div class="col-12">
									<label class="label" for="value">Bid in Dollars</label>
									<input class="input" id="value" name="value" value="{{$next_value}}" type="number" min="{{$next_value}}" placeholder="{{$next_value}}" />
								</div>
								<div class="col-12">
									<input class="button inline" type="submit" value="Place Bid" />
								</div>
							</div>
						</form>

						<p>
							Placing this bid means you commit to paying for it, even if you do not win or are outbid.
							You will only need to pay the difference if you increase your bid.
						</p>
	@else
						You already have the highest bid.
	@endif
@else
						You cannot bid on this day.
@endif
					</div>
				</div>
	@include('templates.nav')
			</div>
@endsection
