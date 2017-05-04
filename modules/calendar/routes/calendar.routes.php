<?php

use Babypool\CalendarController;

Route::get('/', CalendarController::class . '@calendar');

Route::group(['prefix' => 'calendar'], function () {
	Route::any('/finalize', CalendarController::class . '@finalize_bid');
	Route::get( '/',        CalendarController::class . '@calendar');
	Route::get( '/{date}',  CalendarController::class . '@date');
	Route::post('/{date}',  CalendarController::class . '@place_bid');
});