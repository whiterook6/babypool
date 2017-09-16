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

class PaymentMade extends Mailable {
	use Queueable, SerializesModels;

	public $payment;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(Payment $payment) {
		$this->payment = $payment;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->view('emails.payment')
			->with([
				'payment_value' => $this->payment->amount,
				'charge_id' => $this->payment->stripe_charge_id,
				'me_url' => url('/users/me'),
				'transaction_id' => $this->payment->stripe_balance_transaction_id,
			]);
	}
}