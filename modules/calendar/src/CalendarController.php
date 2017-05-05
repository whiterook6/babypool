<?php

namespace Babypool;

use Babypool\BabbyController;
use Babypool\Bid;
use DateTime;
use Illuminate\Http\Request;
use Mail;

class CalendarController extends BabbyController {

	public function calendar(Request $request){
		$bids = [];
		$dates = Bid::active()->distinct('date')->pluck('date');
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
		$this->validate_array([
			'date' => $date,
		], [
			'date' => 'required|date_format:"Y-m-d"',
		]);

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
}