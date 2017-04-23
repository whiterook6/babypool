<?php

namespace whiterook6\Babypool;

use Illuminate\Database\Eloquent\Model;

class Pirate extends Model {

	protected $table = 'pirates';
	protected $fillable = [
		'email'
	];

	public function bids(){
		return $this->hasMany(Bid::class);
	}
}