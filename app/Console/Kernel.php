<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
	   $schedule->call(function () {
			DB::table('bids')->where('status', 'unconfirmed')->whereRaw('created_at <= DATE_SUB(NOW(),INTERVAL 10 MINUTE)')->update([
				'status' => 'cancelled'
			]);
		})->everyTenMinutes();
	}
}
