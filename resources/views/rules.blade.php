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
							<li>The bidder who has the highest bid on the date-of-birth wins half of the total prize.</li>
							<li>The other half is delivered as a gift to the parents.</li>
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
							<li>Only the highest confirmed bid for a day counts ("Successful Bid")</li>
							<li>If you have the successful bid for a day when that day begins, you owe that bid.</li>
							<li>If you have the successful bid for a day when the pool is locked, you owe that bid.</li>
						</ul>
					</div>
					<div class="col-6">
						<h2>To Bid</h2>
						<ol>
							<li>Select a valid day.</li>
							<li>Enter your email address and a bid value that is at least ${{$minimum_raise}} higher than the current highest bid.</li>
							<li>Press <span class="fake-button">place bid</span>.</li>
							<li>In your inbox, open the confirmation email and click <span class="fake-button">confirm bid</span>.</li>
						</ol>

						If you do not confirm your bid within ten minutes, the bid is canceled.

						<h2>To Pay</h2>
						<ol>
							<li>Give Tim the amount owed once you owe it. Bids will be marked as "paid" once the money is collected.</li>
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