<?php

use Babypool\CalendarController;

Route::get('/', CalendarController::class . '@calendar');
Route::get('/calendar', CalendarController::class . '@calendar');

Route::group([
	'prefix' => 'calendar',
	'middleware' => 'auth'
], function () {
	Route::get( '/{date}',   CalendarController::class . '@date');
});