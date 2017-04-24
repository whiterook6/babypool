<?php

namespace Babypool;

use Babypool\Pirate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidController extends Controller {

	public function all(Request $request){
		return Bid::with('pirate')->all();
	}

	public function find($id, Request $request){

		return Bid::with('pirate')->findOrFail($id);
	}

	public function create(Request $request){
		$min_bid = env('MINIMUM_BID', 5);
		$min_increment = env('MINIMUM_INCREMENT', 5);

		$this->validate($request, [
			'email' => 'required|email',
			'date' => 'required|date',
			'value' => "required|numeric|min:{$min_bid}",
		]);

		$email = $request->input('email');
		$date = $request->input('date');
		$value = $request->input('value');
		
		$count = Bid::where('date', $request->input('date'))->where('value' > ($value-$min_increment))->count();
		if ($count > 0){

		}

		$pirate = Pirate::findOrCreate([
			'email' => $request->input('email')
		]);

		Bid::create([
			'pirate_id' => $pirate->id,
			'date' => $date,
			'value' => $value,
			'confirmed' => false
		]);
	}

	public function confirm($id, Request $request){
		$this->validate($request, [
			'token' => 'required|string'
		]);

		$decrypted = $this->get_valid_token($request->input('token'), [
			'bid_id' => 'required|exists:bids,id',
			'pirate_id' => 'required|exists:pirates,id'
		]);

		$bid_id = $decrypted['bid_id'];
		$pirate_id = $decrypted['pirate_id'];

		$bid = Bid::where('pirate_id', $pirate_id)->with('pirate')->findOrFail($bid_id);
		$bid['confirmed'] = true;
		$bid->save();

		return $bid;
	}
}