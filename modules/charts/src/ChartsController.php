<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use Babypool\Bid;
use DateTime;
use Illuminate\Http\Request;

class ChartsController extends BabbyController {

	public function view(Request $request){
		return view('charts');
	}
}