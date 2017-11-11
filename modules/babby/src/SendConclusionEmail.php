<?php

namespace Babypool;

use Babypool\Bid;
use DateTime;
use Illuminate\Console\Command;

class SendConclusionEmail extends Command {

	/**
	 * The name and signature of the console command.
	 */
	protected $signature = 'email:results';

	/**
	 * The console command description.
	 */
	protected $description = 'Email the users about the results of the pool.';


	/**
	 * Create a new command instance.
	 */
	public function __construct(){
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 */
	public function handle(){
		$birth_date = null;
		$date_of_birth_string = "";

		do {
			$today_string = date('Y-m-d');

			do {
				$date_of_birth_string = $this->ask('What is the date of birth? (YYYY-MM-DD)', $today_string);			
				$birth_date = DateTime::createFromFormat('Y-m-d', $date_of_birth_string);
			} while (!$birth_date);

			$check_input = $birth_date->format('Y-m-d');
			$english = $birth_date->format('l jS \of F Y');
		} while ($check_input === $date_of_birth_string && !($this->confirm("Confirm: {$english}?")));

		$max_date_diff = 30;
		$current_date_diff = 0;
		$bids = collect($this->get_highest_bid($date_of_birth_string));

		while ($bids->isEmpty() && $current_date_diff < $max_date_diff){
			$current_date_diff ++ ;
			$timestamp = strtotime($date_of_birth_string);

			$l_date = date('Y-m-d', strtotime("-{$current_date_diff} days", $timestamp));			
			$r_date = date('Y-m-d', strtotime("+{$current_date_diff} days", $timestamp));

			$bids = $this->get_highest_bids(collect([$l_date, $r_date]));
		}

		// $bids has the winning bid or bids, if split between two dates.

		// edge cases:
		// one person owns both closest dates

		// prompt for date of baby
		// Calculate winner
		// email winner

		// calculate who owes money
		// email those who owe money
	}

	private function get_highest_bid($date_string){
		return Bid::with('user')->where('date', $date_string)->highest()->first();
	}

	private function get_highest_bids($date_strings){
		$bids = collect();
		$date_strings->each(function($date_string) use ($bids){
			$bid = $this->get_highest_bid($date_string);
			if (!is_null($bid)){
				$bids->push($bid);
			}
		});

		return $bids;
	}
}