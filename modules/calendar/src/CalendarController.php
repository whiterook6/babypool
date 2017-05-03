<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Babypool\Bid;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){

		$bids = [];
		$dates = Bid::where('status', '!=', 'cancelled')->distinct('date')->pluck('date');
		$dates->each(function($date) use (&$bids){
			$bid = Bid::where('date', $date)->active()->highest()->first();
			if ($bid){
				$bids[$date] = $bid;
			}
		});

		return view('calendar', [
			'bids' => $bids
		]);
	}

	public function date($date, Request $request){

		$bids = Bid::where('date', $date)->active()->highest()->with('bidder')->get();
		$head = $bids->first();
		$tail = $bids->slice(1);

		if ($head){
			$next_value = $head->value + env('MINIMUM_INCREMENT', 1);
		} else {
			$next_value = env('MINIMUM_BID', 5);
		}

		return view('day', [
			'current_bid' => $head,
			'date' => $date,
			'date_string' => DateTime::createFromFormat('Y-m-d', $date)->format('l, F jS'),
			'next_value' => $next_value,
			'previous_bids' => $tail,
		]);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}