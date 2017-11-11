<?php

namespace Babypool;

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

		do {
			$today_string = date('Y-m-d');
			$date_of_birth_string = "";

			do {
				$date_of_birth_string = $this->ask('What is the date of birth? (YYYY-MM-DD)', $today_string);			
				$birth_date = DateTime::createFromFormat('Y-m-d', $date_of_birth_string);
			} while (!$birth_date);

			$check_input = $birth_date->format('Y-m-d');
			$english = $birth_date->format('l jS \of F Y');
		} while ($check_input === $date_of_birth_string && !($this->confirm("Confirm: {$english}?")));
		// prompt for date of baby
		// Calculate winner
		// email winner

		// calculate who owes money
		// email those who owe money
	}
}