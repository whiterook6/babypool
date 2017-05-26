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
	@if ($total_owing > 0)
					<script src="https://js.stripe.com/v3/"></script>
					<div class="col-sm-4">
						<h2>Pay with Stripe</h2>
						<form method="POST" action="/pay" class="form">
							<label for="cardholder-name" class="label">Name</label>
							<input id="cardholder-name" name="cardholder-name" class="input" placeholder="Jane Doe" />
							<label for="card-element" class="label">Credit Card</label>
							<div id="card-element" class="input"></div>
							<p>Clicking below will charge your credit card ${{$total_owing}}. If you increase your existing bids,
								or place any more bids, you will be required to make another payment.</p>
							<button id="submit" type="submit" class="button block">Pay ${{$total_owing}}</button>
						</form>
					</div>
					<script>
var stripe = Stripe('pk_test_6pRNASCoBOKtIshFeQd4XMUh');
var elements = stripe.elements();

var card = elements.create('card', {
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '1rem',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#CFD7E0',
      },
    },
  }
});
card.mount('#card-element');

document.querySelector('form').addEventListener('submit', function(e) {
  e.preventDefault();
  var form = document.querySelector('form');
  var extraDetails = {
    name: form.querySelector('input[name=cardholder-name]').value,
  };
  stripe.createToken(card, extraDetails).then(setOutcome);
});
</script>
	@endif
				</div>
@include('templates.nav')
			</div>
@endsection
