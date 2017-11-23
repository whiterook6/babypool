<?php

namespace Babypool;

use Babypool\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Stripe\Charge;


class Payment extends Model {

	protected $table = 'payments';
	protected $fillable = [
		'amount',
		'captured',
		'status',
		'stripe_balance_transaction_id',
		'stripe_charge_id',
		'stripe_created',
		'stripe_data',
		'user_id',
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];

	protected $casts = [
		'stripe_data' => 'array',
	];

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function scopeSuccessful(Builder $query){
		return $query->where('captured', true)->where('status', 'succeeded');
	}

	public static function create_from_charge(User $user, Charge $charge){
		return static::create([
			'user_id' => $user->id,
			'amount' => floatval($charge->amount) / 100.0,
			'captured' => $charge->captured,
			'status' => $charge->status,
			'stripe_balance_transaction_id' => $charge->balance_transaction,
			'stripe_charge_id' => $charge->id,
			'stripe_created' => $charge->created,
			'stripe_data' => $charge
		]);
	}
}