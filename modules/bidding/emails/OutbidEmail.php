<?php

namespace Babypool;

use Babypool\BidController;
use Babypool\User;
use Babypool\Bid;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OutbidEmail extends Mailable {
	use Queueable, SerializesModels;

	public $old_bid;
	public $new_bid;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(Bid $old_bid, Bid $new_bid) {
		$this->old_bid = $old_bid;
		$this->new_bid = $new_bid;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		$date_url = url("calendar/{$this->old_bid->date}");
		$old_bid_value = $this->old_bid->value;

		$date_time = DateTime::createFromFormat('Y-m-d', $this->old_bid->date);
		$date_string = $date_time->format('l, F jS');
		$new_bid_value = $this->new_bid->value;

		return $this->view('emails.outbid')
			->with([
				'date_string' => $date_string,
				'date_url' => $date_url,
				'new_bid_value' => $new_bid_value,
				'old_bid_value' => $old_bid_value,
			]);
	}
}