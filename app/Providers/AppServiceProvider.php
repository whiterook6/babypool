<?php

namespace App\Providers;

use Babypool\CalendarController;
use Babypool\BidderController;
use Babypool\BidController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(CalendarController::class, function ($app) {
			return new CalendarController;
		});
		$this->app->singleton(BidderController::class, function ($app) {
			return new BidderController;
		});
		$this->app->singleton(BidController::class, function ($app) {
			return new BidController;
		});
	}
}
