<?php

use Babypool\CalendarController;

Route::get('/', CalendarController::class . '@calendar');

Route::group([
	'prefix' => 'calendar'
], function () {
	Route::get( '/',         CalendarController::class . '@calendar');
	Route::get( '/{date}',   CalendarController::class . '@date');
});