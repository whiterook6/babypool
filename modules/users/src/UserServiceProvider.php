<?php

namespace Babypool\Providers;

use Babypool\LoginController;
use Babypool\UserController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap the application services.
	 */
	public function boot() {
		$this->publishes([
			__DIR__.'/../migrations/' => base_path('/database/migrations'),
		], 'migrations');

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
		$this->app->singleton(LoginController::class, function ($app) {
			return new LoginController;
		});
		$this->app->singleton(UserController::class, function ($app) {
			return new UserController;
		});
	}
}