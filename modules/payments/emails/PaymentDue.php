<?php

namespace Babypool;

use Babypool\BidController;
use Babypool\User;
use Babypool\Payment;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentDue extends Mailable {
	use Queueable, SerializesModels;

	public $user;
	public $bids;
	public $payments;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, array $bids, array $payments) {
		$this->user = $user;
		$this->bids = $bids;
		$this->payments = $payments;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		$total_bid = 0;
		foreach ($this->bids as $bid) {
			$total_bid += $bid['amount'];
		}

		$total_paid = 0;
		foreach ($this->payments as $payment) {
			$total_paid += $payment['amount'];
		}

		return $this->view('emails.bill')
			->with([
				'bids' => $this->bids,
				'initials' => $this->user->initials,
				'me_url' => url('/users/me'),
				'payments' => $this->payments,
				'total_bid' => $total_bid,
				'total_paid' => $total_paid,
			]);
	}
}