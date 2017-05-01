<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PirateController extends Controller {

	public function calendar(Request $request){
		return view('calendar');
	}

	public function date($date, Request $request){
		return response("calendar/{$date}", 200);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}