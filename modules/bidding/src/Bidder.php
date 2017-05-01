<?php

namespace Babypool;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model {

	protected $table = 'bidders';
	protected $fillable = [
		'email'
	];

	public function bids(){
		return $this->hasMany(Bid::class);
	}
}