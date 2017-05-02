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

	public function scopeCalendar(Builder $query){
		return $query->select([
			'bids.*',
			DB::raw('weekofyear(date) as week'),
			DB::raw('dayofweek(date) as dow'),
			DB::raw('month(date) as month'),
			DB::raw('dayofmonth(date) as dom'),
			DB::raw('year(date) as year'),
		])->orderBy('date', 'asc');
	}

	public function scopeActive(Builder $query){
		return $query->where('status', '!=', 'cancelled');
	}
}