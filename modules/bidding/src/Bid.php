<?php

namespace Babypool;

use Babypool\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {

	protected $table = 'bids';
	protected $fillable = [
		'value',
		'user_id',
		'date',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'date'
	];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function scopeHighest(Builder $query){
		return $query->orderBy('value', 'desc');
	}
}