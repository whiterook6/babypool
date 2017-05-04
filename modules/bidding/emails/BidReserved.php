<?php

namespace Babypool;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BidReserved extends Mailable {
    use Queueable, SerializesModels;

    public $bid;
    public $bidder;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $bid, Bidder $bidder) {
        $this->bid = $bid;
        $this->bidder = $bidder;
        $this->confirm_url = 'confirm';
        $this->cancel_url = 'cancel';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.reserved');
    }
}