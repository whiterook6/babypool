<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;

class UserController extends BabbyController {
	
	public function me(){
		$user = Auth::user();
		$user->load('bids');

		$total_bid = $user->bids->sum('value');
		$total_paid = 0;

		return view('me', [
			'total_bid' => $total_bid,
			'total_owing' => $total_bid - $total_paid,
			'total_paid' => $total_paid,
			'user' => $user,
		]);
	}
}