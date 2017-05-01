<?php

namespace Babypool\Providers;

use Babypool\BidderController;
use Babypool\BidController;
use Illuminate\Support\ServiceProvider;

class BiddingServiceProvider extends ServiceProvider {
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
	}

	/**
	 * Register the application services.
	 */
	public function register() {
		$this->app->singleton(BidderController::class, function ($app) {
			return new BidderController;
		});
		$this->app->singleton(BidController::class, function ($app) {
			return new BidController;
		});
	}
}