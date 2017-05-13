<?php

namespace Babypool;

use Auth;
use Closure;

class CheckLoginMiddleware {

	public function handle($request, Closure $next){
		if (!Auth::check()){
			$path = $request->path();
			return redirect("/login?continue={$path}");
		} else {
			return $next($request);
		}
	}
}
