<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use DB;
use Illuminate\Http\Request;

class ChartsController extends BabbyController {

	public function view(Request $request){
		$top_users_by_value = User::leftJoin(
			DB::raw('(SELECT user_id, SUM(value) AS total_value FROM bids GROUP BY user_id) as b'),
			'b.user_id',
			'=',
			'users.id'
		)->orderBy('total_value', 'desc')
			->take(10)
			->get();

		$top_users_by_bid_count = User::leftJoin(
			DB::raw('(SELECT user_id, count(*) AS count FROM bids GROUP BY user_id) as b'),
			'b.user_id',
			'=',
			'users.id'
		)->orderBy('count', 'desc')
			->take(10)
			->get();

		$top_dates_by_value = Bid::selectRaw('date, sum(value) AS total_value')
			->groupBy('date')
			->orderBy('total_value', 'desc')
			->orderBy('date', 'asc')
			->take(10)
			->get();

		$data = [
			'top_users_by_value' => $top_users_by_value,
			'top_users_by_bid_count' => $top_users_by_bid_count,
			'top_dates_by_value' => $top_dates_by_value,
		];

		return view('charts', $data);
	}
}