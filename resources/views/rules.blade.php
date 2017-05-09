@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Rules')

@section('content')
			<div class="container">
				<h1>
					Rules
					<small>and instructions</small>
					<div class="right">
						<small>Total raised:</small>
						$50
					</div>
				</h1>

				<div class="row">
					<div class="col-6">
						<h2>About Prizes</h2>
						<ul>
							<li>The total prize is the sum of all successful bids.</li>
							<li>Half of the total prize is delivered as a gift to the parents.</li>
							<li>The bidder who has the highest bid on or closest to the date-of-birth wins half of the total prize.</li>
							<li>If two people have the closest bids, they split the winner's half of the prize: 1/4 to each winner, and 1/2 to the parents.</li>
						</ul>

						<h2>About Bidding</h2>
						<ul>
							<li>All bids are public.</li>
							<li>You cannot bid at all if the mother has gone into labor.</li>
							<li>The minimum bid for a day is ${{$minimum_bid}}.</li>
							<li>The minimum raise on an existing bid is ${{$minimum_raise}}.</li>
						</ul>

						You cannot bid for a given date if
						<ul>
							<li>that day has already started;</li>
							<li>another bidder has an unconfirmed bid for that day; or</li>
							<li>you already have the highest bid for that day.</li>
						</ul>

						<h2>About Paying</h2>
						<ul>
							<li>You must pay for each bid.</li>
							<li>You must only pay the difference when raising your bid.</li>
						</ul>
					</div>
					<div class="col-6">
						<h2>To Bid</h2>
						<ol>
							<li>Select a valid day.</li>
							<li>Choose a value for your bid. It must be the same as or greater than the minimum bid for that day.</li>
							<li>You may be asked to log in.</li>
						</ol>

						<h2>To Pay</h2>
						<ol>
							<li>BABBY uses Stripe for payment processing. This requires a valid credit card.</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form">
						<a class="button inline"
							href="/calendar">Calendar</a>
					</div>
				</div>
			</div>
@endsection