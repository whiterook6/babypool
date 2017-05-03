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

	public function scopeHighestPerDate(Builder $query){
		$query->join('bids as b', function($join){
			$join->on('bids.value', '=', 'b.value')
				->on('bids.date', '=', 'b.date')
				->select('b.date, max(b.value) as value')
				->where('status', '!=', 'cancelled')
				->groupBy('date');
		})->select('b.*');

		return $query;
	}
}