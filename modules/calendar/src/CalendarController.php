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

	public function place_bid($date, Request $request){
		$minimum_bid = env('MINIMUM_BID', 5);
		$minimum_increment = env('MINIMUM_INCREMENT', 1);

		$this->validate($request, [
			'email' => 'required|email',
			'value' => "required|integer|min:{$minimum_bid}",
		]);
		$value = $request->input('value');
		$email = $request->input('email');

		$existing_bid = Bid::where('date', $date)->active()->select('value')->highest()->first();
		if ($existing_bid){
			$min_value = $existing_bid->value + $minimum_increment;
		} else {
			$min_value = $minimum_bid;
		}

		$tomorrow = (new DateTime('tomorrow'))->format('Y-m-d');

		$this->validate_array([
			'date' => $date,
			'value' => $value,
		], [
			'date' => 'required|date_format:"Y-m-d"',
			'value' => 'min:$minimum_bid',
		]);

		if ($date < $tomorrow){
			throw new \Exception('Bids must be placed for future days.');
		}

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
}