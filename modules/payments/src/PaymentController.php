<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends BabbyController {
	public function pay(Request $request){
		$this->validate($request, [
			'token' => 'required|string',
			'owing_encrypted' => 'required|string'
		]);
		$user = Auth::user();

		$owing = intval(decrypt($request->input('owing_encrypted')));
		$token = $request->input('token');

		Stripe::setApiKey('sk_test_BQokikJOvBiI2HlWgH4olfQ2');
		$charge = Charge::create([
			'amount' => $owing * 100,
			'currency' => 'cad',
			'description' => 'Babypool Payment',
			'source' => $token,
		]);

		$payment = Payment::create_from_charge($user, $charge);
		return redirect(action('\\'.UserController::class.'@me'));
	}
}