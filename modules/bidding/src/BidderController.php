<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidderController extends Controller {

	public function bidders(Request $request){
		return response('bidders', 200);
	}

	public function me(Request $request){
		return response('bidders/me', 200);
	}

	public function bidder($email, Request $request){
		return response("bidders/{$email}", 200);
	}
}