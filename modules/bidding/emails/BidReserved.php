<?php

namespace Babypool;

use Babypool\BidController;
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $confirm_token = $this->bid->get_confirm_token();
        $cancel_token = $this->bid->get_cancel_token();

        return $this->view('emails.reserved')
            ->with([
                'confirm_url' => action('\\'.BidController::class.'@finalize_bid', ['token' => $confirm_token]),
                'cancel_url' => action('\\'.BidController::class.'@finalize_bid', ['token' => $cancel_token]),
            ]);
    }
}