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

		$bids = Bid::where('date', $date)->highest()->with('user')->get();
		$head = $bids->first();
		$tail = $bids->slice(1);

		if ($head){
			$next_value = $head->value + env('MINIMUM_INCREMENT', 1);
		} else {
			$next_value = env('MINIMUM_BID', 5);
		}

		$date_time = DateTime::createFromFormat('Y-m-d', $date);
		$date_time->setTime(0,0,0);

		$today = new DateTime();
		$today->setTime(0,0,0);

		$start_year = intval(env('EARLIEST_BID_YEAR', 2017));
		$start_week = intval(env('EARLIEST_BID_WEEK', 0));
		$start_date = new DateTime();
		$start_date->setISODate($start_year, $start_week);
		$start_date->setTime(0,0,0);

		$minus_one_day = date_interval_create_from_date_string("-1 day");
		$previous_date = clone $date_time;
		$previous_date->add($minus_one_day);

		$plus_one_day = date_interval_create_from_date_string("1 day");
		$next_date = clone $date_time;
		$next_date->add($plus_one_day);

		$is_logged_in = Auth::check();

		return view('day', [
			'can_bid' => $date_time >= $today && $date_time >= $start_date && $is_logged_in,
			'current_bid' => $head,
			'date' => $date,
			'date_string' => $date_time->format('l, F jS'),
			'has_highest_bid' => $head && $head['user_id'] == Auth::id(),
			'is_logged_in' => $is_logged_in,
			'next_date' => $next_date->format('Y-m-d'),
			'next_value' => $next_value,
			'previous_bids' => $tail,
			'previous_date' => $previous_date->format('Y-m-d'),
		]);
	}
}