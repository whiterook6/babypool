<?php

namespace Babypool\Providers;

use Babypool\CalendarController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 */
	public function boot() {
		// $this->publishes([
		// 	__DIR__.'/../migrations/' => base_path('/database/migrations'),
		// ], 'migrations');

		// $this->publishes([
		// 	__DIR__.'/../factories/' => base_path('/database/factories'),
		// ], 'factories');

		$this->publishes([
			__DIR__.'/../routes/' => base_path('/routes'),
		], 'routes');

		// views
		View::composer('calendar', function ($view) {
			$view->with('min_week', env('EARLIEST_BID_WEEK', 0));
			$view->with('max_week', env('LATEST_BID_WEEK', 52));
		});
	}

	/**
	 * Register the application services.
	 */
	public function register() {
		$this->app->singleton(CalendarController::class, function ($app) {
			return new CalendarController;
		});
	}
}