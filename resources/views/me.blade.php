@extends('templates.app') <!-- Refers to templates/app.blade.php -->

@section('title', 'Me')

@section('content')
			<div class="container">
				<h1>Currently Logged In: {{$user['initials']}}</h1>

				<div class="row">
					<div class="col-sm-4">
						<h2>Bids</h2>
	@if (!empty($user['bids']))
						<div class="bids">
		@foreach ($user['bids'] as $bid)
							<div class="bid">
								<a href="/calendar/{{$bid['date']}}">{{$bid['date']}}</a>: ${{$bid['value']}}
							</div>
		@endforeach
						</div>
	@else
						<div>No bids.</div>
	@endif
						<h2>Payments</h2>
	@if (count($user['payments']) > 0)
						<div class="payments">
		@foreach ($user['payments'] as $payment)
							<div class="payment">
								Paid ${{$payment['amount']}} on {{$payment['created_at']}}.
							</div>
		@endforeach
						</div>
	@else
						No payments captured.
	@endif
					</div>
					<div class="col-sm-4">
						<h2>Total Amount Bid</h2>
						${{$total_bid}}

						<h2>Total Amount Paid</h2>
						${{$total_paid}}
	@if ($total_owing > 0)
						(${{$total_owing}} owing.)
	@elseif ($total_owing < 0)
						(${{-$total_owing}} extra.)
	@endif
					</div>
					<div class="col-sm-4">
						<h2>Pay with Stripe</h2>
	@if ($total_owing > 0)
						<script src="https://js.stripe.com/v3/"></script>
						<form method="POST" action="/pay" class="form" id="stripe-form">
							<input type="hidden" name="owing_encrypted" value="{{$owing_encrypted}}" />
							<label for="cardholder-name" class="label">Name</label>
							<input id="cardholder-name" name="cardholder-name" class="input" placeholder="Jane Doe" />
							<label for="card-element" class="label">Credit Card</label>
							<div id="card-element" class="input"></div>
							<p>Clicking below will charge your credit card ${{$total_owing}}. If you increase your existing bids,
								or place any more bids, you will be required to make another payment.</p>
							<button class="button block">Pay ${{$total_owing}}</button>
						</form>
						<script>
var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
var elements = stripe.elements();
var form = document.querySelector('form#stripe-form');
var card = elements.create('card', {
	style: {
		base: {
			iconColor: '#666EE8',
			color: '#31325F',
			lineHeight: '1rem',
			fontWeight: 300,
			fontFamily: '"Source Sans Pro", Helvetica, sans-serif',
			fontSize: '15px',
			'::placeholder': {
				color: '#CFD7E0',
			},
		},
	}
});

card.mount('#card-element');

function stripeTokenHandler(token){
	var hidden_input = document.createElement('input');
	hidden_input.setAttribute('type', 'hidden');
	hidden_input.setAttribute('name', 'token');
	hidden_input.setAttribute('value', token);
	form.appendChild(hidden_input);
	form.submit();
}

form.addEventListener('submit', function(e) {
	e.preventDefault();
	var extraDetails = {
		name: form.querySelector('input#cardholder-name').value,
	};
	stripe.createToken(card, extraDetails).then(function(response){
		if (response.token){
			stripeTokenHandler(response.token.id)
		} else {
			console.log(response);
		}
	});
});
						</script>
	@else
						No payments needed.
					</div>
	@endif
				</div>
@include('templates.nav')
			</div>
@endsection
