<?php

namespace whiterook6\Babypool;

use whiterook6\Babypool\Pirate;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {

	protected $table = 'bids';
	protected $fillable = [
		'amount',
		'bidder_id',
		'confirmed',
		'date',
	];

	public function pirate(){
		return $this->belongsTo(Bidder::class);
	}
}