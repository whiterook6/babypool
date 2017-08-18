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

class BidReserved extends Mailable {
    use Queueable, SerializesModels;

    public $bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $bid) {
        $this->bid = $bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $me_url = url('/users/me');
        $date_time = DateTime::createFromFormat('Y-m-d', $this->bid->date);
        $date_string = $date_time->format('l, F jS');

        return $this->view('emails.reserved')
            ->with([
                'me_url' => $me_url,
                'bid' => $this->bid,
                'date_string' => $date_string,
            ]);
    }
}