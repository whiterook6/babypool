@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Title')

@section('content')
			<div class="container">
				<h1>
					{{$date}}
				</h1>
				<div class="row">
					<div class="col-sm-4">
						<h2>Current Bid: <small>$50</small></h2>
						<div class="bids">
							<div class="bid">
								<span class="fa fa-clock-o"></span>
								<span class="email">whiterook6@gmail.com</span>
								<span class="value">$55</span>
								<span class="date">May 4th</span>
							</div>

							<div class="bid">
								<span class="fa fa-check"></span>
								<span class="email">whiterook6@gmail.com</span>
								<span class="value">$55</span>
								<span class="date">May 4th</span>
							</div>
						</div>

						<h2>Previous Bids</h2>

						<div class="bids">
							<div class="bid disabled">
								<span class="fa fa-check"></span>
								<span class="email">whiterook6@gmail.com</span>
								<span class="value">$55</span>
								<span class="date">May 4th</span>
							</div>

							<div class="bid disabled">
								<span class="fa fa-check"></span>
								<span class="email">whiterook6@gmail.com</span>
								<span class="value">$55</span>
								<span class="date">May 4th</span>
							</div>

							<div class="bid disabled">
								<span class="fa fa-check"></span>
								<span class="email">whiterook6@gmail.com</span>
								<span class="value">$55</span>
								<span class="date">May 4th</span>
							</div>
						</div>
					</div>

					<div class="col-sm-8">
						<h2>To Raise: <small>$55</small></h2>
						<form class="form">
							<div class="row">
								<div class="col-xs-6">
									<label class="label" for="email">Email Address</label>
									<input class="input" id="email" type="email" placeholder="example@gmail.com" />
								</div>
								<div class="col-xs-6">
									<label class="label" for="bid">Bid in Dollars</label>
									<input class="input" id="bid" type="number" placeholder="55" />
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
