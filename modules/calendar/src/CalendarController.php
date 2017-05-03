<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){

		$bids = Bid::calendar()
			->highestPerDate();
		\Log::info($bids->toSql());
		

		return view('calendar', [
			'bids' => $bids->get()
		]);
	}

	public function date($date, Request $request){
		return response("calendar/{$date}", 200);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}