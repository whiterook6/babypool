<?php

namespace Babypool;

use DateTime;
use Illuminate\View\View;
use DB;

class CalendarViewComposer {
	public function compose(View $view){
		$total_pot = DB::table('bids')->sum('value');

		$start_year = intval(env('EARLIEST_BID_YEAR', 2017));
		$start_week = intval(env('EARLIEST_BID_WEEK', 0));

		$end_year = intval(env('LATEST_BID_YEAR', 2017));
		$end_week = intval(env('LATEST_BID_WEEK', 53));

		$start_date = new DateTime();
		$start_date->setISODate($start_year, $start_week);
		$current_date = clone $start_date;

		$end_date = new DateTime();
		$end_date->setISODate($end_year, $end_week, 6);

		$due_date = env('DUE_DATE', '0001-01-01');

		$interval = date_diff($start_date, $end_date); // get interval between start and end
		$days = intval($interval->format('%a')) + 1; // get days of interval

		$calendar = [];
		$week = $start_week;
		$day_of_week = 0;
		$interval = date_interval_create_from_date_string("1 day");
		$previous_month = $current_date->format('F');

		for ($day = 0; $day <= $days; $day ++ ){
			if (!array_key_exists($week, $calendar)){
				$calendar[$week] = [
					'week' => $week,
					'days' => [],
				];
			}

			$current_date_string = $current_date->format('Y-m-d');

			array_push($calendar[$week]['days'], [
				'date' => $current_date_string,
				'day_of_month' => intval($current_date->format('d')),
				'is_due_date' => ($due_date == $current_date_string),
			]);
			$new_month = $current_date->format('F');

			$current_date->add($interval);
			$day_of_week ++;

			// split week
			if ($day_of_week >= 7){
				$day_of_week = 0;

				// do we print the label?
				if ($new_month != $previous_month || $week == $start_week){
					$calendar[$week]['label'] = $new_month;
					$previous_month = $new_month;
				}

				$week ++;
			}
		}

		\Log::info($calendar);

		$view->with([
			'total_pot' => $total_pot,
			'calendar' => $calendar
		]);
	}
}