<?php

namespace Babypool;

use Babypool\BabbyController;
use Babypool\Bid;
use DateTime;
use Illuminate\Http\Request;

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
			'date' => $date
		], [
			'date' => 'required|date_format:"Y-m-d"'
		]);
		$date = $request->input('date');

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

	public function place_bid(Request $request){
		$minimum_bid = env('MINIMUM_BID', 5);
		$minimum_increment = env('MINIMUM_INCREMENT', 1);

		$this->validate($request, [
			'date' => 'required|date_format:"Y-m-d"',
			'email' => 'required|email',
			'value' => "required|integer|min:{$minimum_bid}",
		]);
		$date=$request->input('date');
		$value = $request->input('value');
		$email = $request->input('email');

		$min_value = max(
			Bid::where('date', $date)->active()->select('value')->highest()->first()->value,
			$minimum_bid
		) + $minimum_increment;

		$this->validate_array([
			'value' => $value
		], [
			'value' => 'min:$minimum_bid'
		]);

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

		return response('Check your email', 200);
	}
}