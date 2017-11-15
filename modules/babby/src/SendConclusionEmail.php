<?php

namespace Babypool;

use Babypool\Bid;
use DateTime;
use DB;
use Illuminate\Console\Command;
use Mail;

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
		$english = "";

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
		$bids = collect([$this->get_highest_bid($date_of_birth_string)]);

		while ($bids->isEmpty() && $current_date_diff < $max_date_diff){
			$current_date_diff ++ ;
			$timestamp = strtotime($date_of_birth_string);

			$l_date = date('Y-m-d', strtotime("-{$current_date_diff} days", $timestamp));			
			$r_date = date('Y-m-d', strtotime("+{$current_date_diff} days", $timestamp));

			$bids = $this->get_highest_bids(collect([$l_date, $r_date]));
		}

		if ($bids->count() == 0){
			$this->error('No bids in range. Aborting!');
			return;
		}

		$total_pot = DB::table('bids')->sum('value');
		$users = User::has('bids')->get();

		if ($bids->count() == 1){
			$this->info('One winning bid: ');
			$this->info($bids->first()->toJson());

			$users->each(function($user) use ($bids, $english, $total_pot){
				$this->info("Sending email to {$user->email}");
				$is_winner = ($user->id == $bids->first()->user_id);
				
				Mail::to($user->email)->send(new ResultsEmail(
					$user, // current_user
					$bids->first(), // left_bid,
					null,
					$total_pot,
					$english, // date of birth string
					$is_winner // is winner
				));
			});

		} else if ($bids->count() > 2){
			$this->error('Too many winning bids. Aborting!');
			return;

		} else {
			$this->info('Two winning bids:');
			$this->info($bids->toJson());

			$users->each(function($user) use ($bids, $english, $total_pot){
				$this->info("Sending email to {$user->email}");

				if ($bids->first()->user_id == $user->id){
					$this->info("User is left bidder");
					Mail::to($user->email)->send(new ResultsEmail(
						$user, // current_user
						$bids->first(), // left_bid,
						$bids->last(), // right big
						$total_pot,
						$english, // date of birth string
						true // is winner
					));
				} else if ($bids->last()->user_id == $user->id){
					$this->info("User is right bidder");
					Mail::to($user->email)->send(new ResultsEmail(
						$user, // current_user
						$bids->last(), // left_bid,
						$bids->first(), // right big
						$total_pot,
						$english, // date of birth string
						true // is winner
					));
				} else {
					$this->info("User is not a winner.");
					Mail::to($user->email)->send(new ResultsEmail(
						$user, // current_user
						$bids->first(), // left_bid,
						$bids->last(), // right big
						$total_pot,
						$english, // date of birth string
						false // is winner
					));
				}
			});
		}
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