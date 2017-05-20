<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use Babypool\Bid;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends BabbyController {

	public function calendar(Request $request){
		$bids = [];
		$dates = Bid::distinct('date')->pluck('date');
		$dates->each(function($date) use (&$bids){
			$bid = Bid::where('date', $date)->highest()->first();
			if ($bid){
				$bids[$date] = $bid;
			}
		});

		$data = [
			'bids' => $bids
		];

		if (Auth::user()){
			$data['user'] = Auth::user();
		}

		return view('calendar', $data);
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

		$date_time = DateTime::createFromFormat('Y-m-d', $date);

		$minus_one_day = date_interval_create_from_date_string("-1 day");
		$previous_date = clone $date_time;
		$previous_date->add($minus_one_day);

		$plus_one_day = date_interval_create_from_date_string("1 day");
		$next_date = clone $date_time;
		$next_date->add($plus_one_day);

		return view('day', [
			'current_bid' => $head,
			'date' => $date,
			'date_string' => $date_time->format('l, F jS'),
			'next_date' => $next_date->format('Y-m-d'),
			'next_value' => $next_value,
			'previous_bids' => $tail,
			'previous_date' => $previous_date->format('Y-m-d'),
		]);
	}
}