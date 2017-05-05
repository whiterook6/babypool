<?php

namespace Babypool;

use Babypool\Bidder;
use Babypool\BabbyController;
use Illuminate\Http\Request;

class BidController extends BabbyController {

	public function place_bid($date, Request $request){
		if (env('LOCKED', false)){
			throw new \Exception('All bidding is locked.');
		}

		$this->validate($request, [
			'email' => 'required|email',
			'value' => "required|integer|min:{$minimum_bid}",
		]);
		$value = $request->input('value');
		$email = $request->input('email');

		$this->validate_date($date);

		DB::transaction(function() use ($date, $value, $email){
			$this->validate_bids($date, $value, $email);

			$bidder = Bidder::firstOrCreate([
				'email' => $email
			]);
			$bid = Bid::create([
				'bidder_id' => $bidder->id,
				'value' => $value,
				'date' => $date,
				'status' => 'unconfirmed'
			]);

			Mail::to($bidder->email)->send(new BidReserved($bid, $bidder));
		});

		return response('Check your email', 200);
	}

	public function finalize_bid(Request $request){
		$decrypted = $this->get_token($request, [
			'a' => 'required|in:cancel,confirm',
			'bid' => 'required|exists:bids,id'
		]);

		$bid = Bid::findOrFail($decrypted['bid']);
		switch ($decrypted['a']){
			case 'confirm':
				if ($bid->status != 'unconfirmed'){
					throw new \Exception("Can't confirm a bid that isn't unconfirmed");
				}
				$bid->confirm();
				return response('confirmed');
			case 'cancel':
				if ($bid->status != 'unconfirmed'){
					throw new \Exception("Can't cancel a bid that isn't unconfirmed");
				}
				$bid->cancel();
				return response('cancelled');
		}
	}

	private function validate_date($date){
		$tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');

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

	private function validate_bids($date, $value, $email){
		$minimum_bid = intval(env('MINIMUM_BID', 5));
		$minimum_increment = intval(env('MINIMUM_INCREMENT', 1));

		$existing_bid = Bid::where('date', $date)
			->with('bidder')
			->active()
			->highest()
			->first();

		if ($existing_bid){
			$min_value = $existing_bid->value + $minimum_increment;
		} else {
			$min_value = $minimum_bid;
		}

		$this->validate_array([
			'value' => $value,
		], [
			'value' => 'min:$minimum_bid',
		]);

		if ($existing_bid && $existing_bid->bidder){
			$this->validate_array([
				'email' => $email,
			], [
				'email' => "different:{$existing_bid->bidder->email}"
			]);
		}
	}
}