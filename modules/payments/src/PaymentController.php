<?php

namespace Babypool;

use Babypool\BabbyController;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends BabbyController {
	public function pay(Request $request){
		$this->validate($request, [
			'cardholder-name' => 'required|string',
			'token' => 'required|string',
			'owing_encrypted' => 'required|string'
		]);

		$owing = intval(decrypt($request->input('owing_encrypted')));
		$token = $request->input('token');
		$name = $request->input('cardholder-name');

		Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");
		$charge = Charge::create([
			"amount" => $owing,
			"currency" => "cad",
			"description" => "Babypool Payment",
			"source" => $token,
		]);

		\Log::info($charge);
		return 'success';
	}
}