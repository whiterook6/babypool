<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use Babypool\Bid;
use Babypool\Bidder;
use DateTime;
use DB;
use Exception;
use Illuminate\Http\Request;
use Mail;

class BidController extends BabbyController {

	public function place_bid($date, Request $request){
		if (env('LOCKED', false)){
			throw new \Exception('All bidding is locked. Could it be? It is over?');
		}

		$this->validate($request, [
			'value' => 'required|integer',
		]);
		$value = intval($request->input('value'));

		$this->validate_date($date);
		$user = Auth::user();

		DB::transaction(function() use ($date, $value, $user){
			$this->validate_bids($date, $value, $user);

			$bid = Bid::create([
				'user_id' => $user->id,
				'date' => $date,
				'value' => $value,
			]);
		});

		$date_time = DateTime::createFromFormat('Y-m-d', $date);
		$date_string = $date_time->format('l, F jS');

		return view('reserved', [
			'value' => $value,
			'date_string' => $date_string
		]);
	}

	private function validate_date($date){
		$this->validate_array([
			'date' => $date,
		], [
			'date' => 'date_format:"Y-m-d"'
		]);

		$start_year = intval(env('EARLIEST_BID_YEAR', 2017));
		$start_week = intval(env('EARLIEST_BID_WEEK', 0));

		$end_year = intval(env('LATEST_BID_YEAR', 2017));
		$end_week = intval(env('LATEST_BID_WEEK', 52));

		$minimum_date = new DateTime();
		$minimum_date->setISODate($start_year, $start_week);
		$minimum_date = $minimum_date->format('Y-m-d');

		$maximum_date = new DateTime();
		$maximum_date->setISODate($end_year, $end_week, 6);
		$maximum_date = $maximum_date->format('Y-m-d');

		$this->validate_array([
			'date' => $date
		], [
			'date' => "after:today"
				."|after_or_equal:{$minimum_date}"
				."|before_or_equal:{$maximum_date}"
		]);
	}

	private function validate_bids($date, $value, $user){
		$minimum_bid = intval(env('MINIMUM_BID', 5));
		$minimum_increment = intval(env('MINIMUM_INCREMENT', 1));

		$existing_bid = Bid::where('date', $date)
			->with('user')
			->highest()
			->first();

		if ($existing_bid){
			$min_value = $existing_bid->value + $minimum_increment;
		} else {
			$min_value = $minimum_bid;
		}

		if ($value < $min_value){
			throw new \Exception("The minimum bid for {$date} is $$min_value.");
		}

		if ($existing_bid && $existing_bid->user){
			if ($existing_bid->user->id == $user->id){
				throw new \Exception('Cannot bid on a day you already control.');
			}
		}
	}
}