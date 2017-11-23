<?php

namespace Babypool;

use Babypool\Bid;
use DateTime;
use DB;
use Illuminate\Console\Command;
use Mail;

class SendBillEmail extends Command {

	/**
	 * The name and signature of the console command.
	 */
	protected $signature = 'email:payment_due';

	/**
	 * The console command description.
	 */
	protected $description = 'Email the users about the money they owe.';


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
		$users = User::with('payments', 'bids')->get();
		$users->each(function($user){
			$this->info("Processing {$user->email}");
			$total_paid = $user->payments->sum('amount');
			$total_bid = $user->bids->sum('value');

			if ($total_paid >= $total_bid ){
				$this->info("User has paid enough. Continuing...");
				return;
			} else {
				$this->info("User has paid \${$total_paid} but bid \${$total_bid}");
			}

			$bids = [];
			$user->bids->each(function($bid) use (&$bids){
				$bids[] = [
					'date_string' => $bid->date->format('F jS, Y'),
					'amount' => $bid->value
				];
			});

			$payments = [];
			$user->payments->each(function($payment) use (&$payments){
				$payments[] = [
					'date_string' => $payment->created_at->format('F jS, Y'),
					'amount' => $payment->amount
				];
			});

			$this->info("Bids and Payments:");
			$this->info(json_encode($bids));
			$this->info(json_encode($payments));

			Mail::to($user->email)->send(new PaymentDue(
				$user,
				$bids,
				$payments
			));
		});
	}
}