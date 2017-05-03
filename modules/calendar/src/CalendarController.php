<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Babypool\Bid;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){

		$bids = [];
		$dates = Bid::where('status', '!=', 'cancelled')->distinct('date')->orderBy('date', 'asc')->pluck('date');
		$dates->each(function($date) use (&$bids){
			$bid = Bid::where('date', $date)->where('status', '!=', 'cancelled')->orderBy('value', 'desc')->first();
			if ($bid){
				$bids[$date] = $bid;
			}
		});

		return view('calendar', [
			'bids' => $bids
		]);
	}

	public function date($date, Request $request){
		return view('day', [
			'date' => $date
		]);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}