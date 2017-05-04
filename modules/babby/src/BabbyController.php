<?php

namespace Babypool;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Babypool\ValidationException;
use Validator;

abstract class BabbyController extends Controller {

	/**
	 * Overrides the default validator to throw our exception, which our middleware will format properly.
	 */
	public function validate(Request $request, array $rules, array $messages = [], array $attribute_names = []) {
		return $this->validate_array($request->all(), $rules, $messages, $attribute_names);
	}

	/**
	 * Helper function that is more testable than the version that takes a request.
	 */
	public function validate_array(array $to_validate, array $rules, array $messages = [], array $attribute_names = []) {
		$validator = Validator::make($to_validate, $rules);
		if (!empty($attribute_names)) {
			$validator->setAttributeNames($attribute_names);
		}
		if (!empty($messages)) {
			$validator->setCustomMessages($messages);
		}
		if ($validator->fails()){
			throw new ValidationException($validator);
		}
	}

	/**
	 * Decrypts a token, validates its contents, and returns the contents or throws an appropriate exception.
	 */
	public function get_token(Request $request, array $rules) {
		$this->validate($request, [
			'token' => 'required|string'
		]);
		$decrypted = decrypt($request->input('token'));
		$this->validate_array($decrypted, $rules);
		return $decrypted;
	}
}