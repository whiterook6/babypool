<?php

use Babypool\CalendarController;

Route::get('/', CalendarController::class . '@calendar')
	->middleware('web');

Route::group([
	'prefix' => 'calendar',
	'middleware' => 'web'
], function () {
	Route::get( '/',         CalendarController::class . '@calendar');
	Route::get( '/{date}',   CalendarController::class . '@date');
});