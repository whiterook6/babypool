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

class Rebid extends Mailable {
    use Queueable, SerializesModels;

    public $existing_bid;
    public $out_bid;
    public $new_value;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $existing_bid, Bid $out_bid, $new_value) {
        $this->existing_bid = $existing_bid;
        $this->out_bid = $out_bid;
        $this->new_value = $new_value;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $rebid_token = $this->existing_bid->get_rebid_token($this->new_value);
        $date_time = DateTime::createFromFormat('Y-m-d', $this->existing_bid->date);
        $date_string = $date_time->format('l, F jS');

        return $this->view('emails.rebid')
            ->with([
                'rebid_url' => action('\\'.BidController::class.'@rebid', [
                    'token' => $rebid_token,
                ]),
                'existing_bid' => $this->existing_bid,
                'new_value' => $this->new_value,
                'out_bid' => $this->out_bid,
                'date_string' => $date_string
            ]);
    }
}