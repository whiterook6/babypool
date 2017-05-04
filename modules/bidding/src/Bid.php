<?php

namespace Babypool;

use Babypool\Bidder;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {

	protected $table = 'bids';
	protected $fillable = [
		'value',
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

	public function scopeHighest(Builder $query){
		return $query->orderBy('value', 'desc');
	}

	public function get_confirm_token(){
		return encrypt([
			'a' => 'confirm',
			'bid' => $this->id
		]);
	}

	public function get_cancel_token(){
		return encrypt([
			'a' => 'cancel',
			'bid' => $this->id
		]);
	}

	public function confirm(){
		$this->status = 'confirmed';
		$this->save();

		return $this;
	}

	public function cancel(){
		$this->status = 'cancelled';
		$this->save();

		return $this;
	}
}