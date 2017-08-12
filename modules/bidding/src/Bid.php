<?php

namespace Babypool;

use Babypool\User;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model {

	protected $table = 'bids';
	protected $fillable = [
		'date',
		'enable_rebid',
		'status',
		'user_id',
		'value',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function scopeActive(){
		return $this->where('status', '!=', 'cancelled');
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