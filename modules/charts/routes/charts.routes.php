<?php

use Babypool\ChartsController;

Route::group(['prefix' => 'charts'], function () {
	Route::get( '/', ChartsController::class . '@view');
});