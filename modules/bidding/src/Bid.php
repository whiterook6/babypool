<?php

namespace Babypool;

use Babypool\Bidder;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {

	protected $table = 'bids';
	protected $fillable = [
		'amount',
		'bidder_id',
		'status',
		'date',
	];

	public function bidder(){
		return $this->belongsTo(Bidder::class);
	}

	public function scopeActive(Builder $query){
		return $query->where('status', '!=', 'cancelled');
	}
}