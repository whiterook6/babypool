<?php

namespace Babypool;

use Auth;
use Babypool\BabbyController;
use Babypool\Payment;
use Babypool\PaymentMade;
use Exception;
use Illuminate\Http\Request;
use Mail;
use Stripe\Charge;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Error\RateLimit;
use Stripe\Stripe;

class PaymentController extends BabbyController {
	public function pay(Request $request){
		$this->validate($request, [
			'token' => 'required|string',
			'owing_encrypted' => 'required|string'
		]);
		$user = Auth::user();

		$owing = intval(decrypt($request->input('owing_encrypted')));
		$token = $request->input('token');

		try {
			Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
		} catch (Authentication $e){
			throw new Exception('Authentication error. Your card has not been charged.');
		}

		try {
			$charge = Charge::create([
				'amount' => $owing * 100,
				'currency' => 'cad',
				'description' => 'Babypool Payment',
				'source' => $token,
			]);
		
		} catch(Card $e) {
			$body = $e->getJsonBody();
			$error  = $body['error'];

			if (array_key_exists('message', $error)){
				throw new Exception('Stripe reports the card is declined. The specific error message is: '.$error['message']);
			} else {
				throw new Excpetion('Stripe reports the card is declined. There was no specific error message.');
			}
		
		} catch (RateLimit $e) {
			throw new Exception('Stripe reports too many users are making API requests at once. Your card has not been charged.');
		
		} catch (InvalidRequest $e) {
			throw new Exception('Stripe reports invalid parameters were sent from the baby pool. Your card has not been charged.');
		
		} catch (Authentication $e) {
			throw new Exception('Stripe reports an authentication error (after setting its API key.) Your card has not been charged.');
		
		} catch (ApiConnection $e) {
			throw new Exception('Stripe reports a network communication error. Your card has not been charged.');
		
		} catch (Base $e) {
			throw new Exception('Stripe reports a generic error. Your card has not been charged.');
		}

		$payment = Payment::create_from_charge($user, $charge);
		Mail::to($user->email)->send(new PaymentMade($payment));

		return redirect(action('\\'.UserController::class.'@me'));
	}
}