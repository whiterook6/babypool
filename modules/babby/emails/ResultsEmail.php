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

class ResultsEmail extends Mailable {
    use Queueable, SerializesModels;

    public $current_user;
    public $left_bid;
    public $right_bid;
    public $total_pot;
    public $date_of_birth;
    public $is_winner;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $current_user, Bid $left_bid, Bid $right_bid = null, $total_pot, $date_of_birth, $is_winner) {
        $this->current_user = $current_user;
        $this->left_bid = $left_bid;
        $this->right_bid = $right_bid;
        $this->total_pot = $total_pot;
        $this->date_of_birth = $date_of_birth;
        $this->is_winner = $is_winner;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $this->left_bid->load('user');
        $date = $this->left_bid->date;
        $date_time = DateTime::createFromFormat('Y-m-d', $date);
        $data = [
            'left_bid' => [
                'date_string' => $date_time->format('F jS, Y'),
                'initials' => $this->left_bid->user->initials,
                'value' => number_format($this->left_bid->value, 2),
            ],
            'date_of_birth' => $this->date_of_birth,
            'is_winner' => $this->is_winner,
            'winner_pot' => number_format($this->total_pot / 2.0, 2),
            'parent_pot' => number_format($this->total_pot / 2.0, 2),
            'sharing' => false,
            'total_pot' => number_format($this->total_pot, 2),
            'your_initials' => $this->current_user->initials,
        ];

        if (!is_null($this->right_bid)){
            $this->right_bid->load('user');
            $date = $this->right_bid->date;
            $date_time = DateTime::createFromFormat('Y-m-d', $date);

            $data['sharing'] = true;
            $data['right_bid'] = [
                'date_string' => $date_time->format('F jS, Y'),
                'initials' => $this->right_bid->user->initials,
                'value' => number_format($this->right_bid->value, 2),
            ];
            $data['winner_pot'] = number_format($this->total_pot / 4.0, 2);
        }

        \Log::info(json_encode($data));

        return $this->view('emails.results')
            ->with($data);
    }
}