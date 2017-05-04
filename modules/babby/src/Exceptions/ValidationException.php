<?php

namespace Babypool;

use Exception;

class ValidationException extends Exception {
	protected $validator;

	public function __construct($validator = [], $message = null) {
		parent::__construct($message);
		$this->validator = $validator;
	}

	public function validator() {
		return $this->validator;
	}
}