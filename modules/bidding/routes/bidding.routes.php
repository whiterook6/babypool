<?php

use Babypool\BidderController;
use Babypool\BidController;

Route::group(['prefix' => 'bidders'], function(){
	Route::get('/',        BidderController::class . '@bidders');
	Route::get('/me',      BidderController::class . '@me');
	Route::get('/{email}', BidderController::class . '@bidder');
});

Route::group(['prefix' => 'bids'], function(){
	Route::get('/',              BidController::class . '@bids');
	Route::get('/total',         BidController::class . '@total');
	Route::get('/{bid}',         BidController::class . '@bid');
	Route::any('/{bid}/confirm', BidController::class . '@confirm');
});