<?php

use Babypool\PaymentController;

Route::group(['prefix' => '/pay', 'middleware' => 'auth'], function () {
	Route::post( '/',   PaymentController::class . '@pay');
});