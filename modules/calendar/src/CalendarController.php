<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){
		$bids_by_week = Bid::calendar()->all();

		$bids = $bids_by_week->reduce(function($carry, $bid){
			$week = $bid->week;
			$day_of_week = $bid->day;

			if (!$carry || empty($carry)){
				$carry = [
					$week => [
						$day => [ $bid->toArray() ]
					]
				];
			} else if (!array_key_exists($week, $carry)){
				$carry[$week] = [
					$day => [ $bid->toArray() ]
				];
			} else {
				array_push($carry[$week][$day], $bid->toArray());
			}

			return $carry;
		});

		\Log::info($bids);

		return view('calendar', [
			'bids' => $bids
		]);
	}

	public function date($date, Request $request){
		return response("calendar/{$date}", 200);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}