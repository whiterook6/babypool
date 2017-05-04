<?php

namespace Babypool;

use Babypool\Bidder;
use Babypool\BabbyController;
use Illuminate\Http\Request;

class BidController extends BabbyController {

	public function bids(Request $request){
		return response('bids', 200);
	}

	public function total(Request $request){
		return response('bids/total', 200);
	}

	public function bid($bid, Request $request){
		return response("bids/{$bid}", 201);
	}

	public function confirm($bid, Request $request){
		return response("bids/{$bid}/confirm", 201);
	}
}