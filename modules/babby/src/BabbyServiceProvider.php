<?php

namespace Babypool\Providers;

use Babypool\SendConclusionEmail;
use Illuminate\Support\ServiceProvider;

class BabbyServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 */
	public function boot() {}

	/**
	 * Register the application services.
	 */
	public function register() {
		$this->commands([
			SendConclusionEmail::class,
		]);
	}
}