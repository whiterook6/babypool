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
		'confirmed',
		'date',
	];

	public function bidder(){
		return $this->belongsTo(Bidder::class);
	}

	public function scopeCalendar(Builder $query){
		$query->addSelect(DB::raw(
			'weekofyear(date) as week',
			'dayofweek(date) as day'
		))->orderBy('date', 'asc');
	}
}