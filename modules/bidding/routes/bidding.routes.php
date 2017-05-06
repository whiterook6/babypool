<?php

use Babypool\BidderController;
use Babypool\BidController;

Route::group([
	'prefix' => 'bids'
], function(){
	Route::get('/finalize', BidController::class . '@finalize_bid');
	Route::post('/{date}',  BidController::class . '@place_bid');
});

Route::any('/rules', function(){
	return view('rules', [
		'minimum_bid' => ENV('MINIMUM_BID', 5),
		'minimum_raise' => ENV('MINIMUM_RAISE', 1)
	]);
});