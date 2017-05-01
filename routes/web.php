<?php

Route::get('/', '\Babypool\CalendarController@calendar');

Route::group(['prefix' => 'calendar'], function () {
	Route::get( '/',       '\Babypool\CalendarController@calendar');
	Route::get( '/{date}', '\Babypool\CalendarController@date');
	Route::post('/{date}', '\Babypool\CalendarController@place_bid');
});

Route::group(['prefix' => 'bidders'], function(){
	Route::get('/',        '\Babypool\BidderController@bidders');
	Route::get('/me',      '\Babypool\BidderController@me');
	Route::get('/{email}', '\Babypool\BidderController@bidder');
});

Route::group(['prefix' => 'bids'], function(){
	Route::get('/',              '\Babypool\BidController@bids');
	Route::get('/total',         '\Babypool\BidController@total');
	Route::get('/{bid}',         '\Babypool\BidController@bid');
	Route::any('/{bid}/confirm', '\Babypool\BidController@confirm');
});