<?php

namespace Babypool;

use Babypool\BidController;
use Babypool\User;
use Babypool\Bid;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BidReserved extends Mailable {
    use Queueable, SerializesModels;

    public $bid;
    public $new_bid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Bid $bid, bool $new_bid) {
        $this->bid = $bid;
        $this->new_bid = $new_bid;
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
                'cancel_url' => action('\\'.BidController::class.'@finalize_bid', ['token' => $cancel_token]),
                'confirm_url' => action('\\'.BidController::class.'@finalize_bid', ['token' => $confirm_token]),
                'new_bid' => $this->new_bid,
            ]);
    }
}