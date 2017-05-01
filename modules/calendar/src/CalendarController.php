<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){
		$bids_by_week = [];
		Bid::calendar()->each(function($bid) use ($bids_by_week){
			$week = $bid->week;
			$day_of_week = $bid->day;

			if (!$bids_by_week || empty($bids_by_week)){
				$bids_by_week = [
					$week => [
						$day => [ $bid->toArray() ]
					]
				];
			} else if (!array_key_exists($week, $bids_by_week)){
				$bids_by_week[$week] = [
					$day => [ $bid->toArray() ]
				];
			} else {
				array_push($bids_by_week[$week][$day], $bid->toArray());
			}
		});

		\Log::info($bids_by_week);

		return view('calendar', [
			'bids' => $bids_by_week
		]);
	}

	public function date($date, Request $request){
		return response("calendar/{$date}", 200);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}