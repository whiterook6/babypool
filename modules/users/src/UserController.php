<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;

class UserController extends BabbyController {
	
	public function me(){
		$user = Auth::user();
		$user->load('bids', 'payments');

		$total_bid = $user->bids->sum('value');
		$total_paid = $user->payments->filter(function($payment){
			return $payment->captured;
		})->sum('amount');
		$total_owing = $total_bid - $total_paid;

		return view('me', [
			'owing_encrypted' => encrypt($total_owing),
			'stripe_test' => env('STRIPE_TEST', false),
			'stripe_public_key' => env('STRIPE_PUBLIC_KEY', ''),
			'total_bid' => $total_bid,
			'total_owing' => $total_owing,
			'total_paid' => $total_paid,
			'user' => $user,
		]);
	}
}