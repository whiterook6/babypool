<?php

namespace Babypool;

use Closer;
use Exception;

class CatchException {
	public function Handle($request, Closure $next){
		try{
			$response=$next($request);
		} catch (Exception $e){
			return view('errors.generic', [
				'exception' => $e
			]);
		}

		return $response;
	}
}