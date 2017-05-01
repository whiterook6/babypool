<?php

namespace Babypool;

use Babypool\CalendarController;
use Babypool\BidderController;
use Babypool\BidController;

Route::get('/', CalendarController::class . '@calendar');

Route::group(['prefix' => 'calendar'], function () {
	Route::get( '/',       CalendarController::class . '@calendar');
	Route::get( '/{date}', CalendarController::class . '@date');
	Route::post('/{date}', CalendarController::class . '@place_bid');
});

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