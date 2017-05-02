<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller {

	public function calendar(Request $request){
		$bids_by_week = [];
		$bounds = [];

		Bid::calendar()
			->active()
			->orderBy('value', 'desc')
			->each(function($bid, $key) use (&$bids_by_week, &$bounds){
				$year = $bid->year;
				$week = $bid->week;
				$day_of_week = $bid->day;

				// calculate bounds for when to draw a calendar
				if ($key == 0){
					$bounds['min_date'] = [
						'year' => $bid->year,
						'week' => $bid->week,
					];
				}

				$bounds['max_date'] = [
					'year' => $bid->year,
					'week' => $bid->week,
				];

				// order the bids by week, then by day of week
				if (!array_key_exists($week, $bids_by_week)){
					$bids_by_week[$week] = [
						$day_of_week => [ $bid->toArray() ]
					];
				} else if (!array_key_exists($day_of_week, $bids_by_week[$week])){
					$bids_by_week[$week][$day_of_week] = [$bid->toArray()];
				} else {
					array_push($bids_by_week[$week][$day_of_week], $bid->toArray());
				}
			});

		return view('calendar', [
			'bids' => $bids_by_week,
			'bounds' => $bounds,
		]);
	}

	public function date($date, Request $request){
		return response("calendar/{$date}", 200);
	}

	public function place_bid($date, Request $request){
		return response("calendar/{$date}/place_bid", 201);
	}
}