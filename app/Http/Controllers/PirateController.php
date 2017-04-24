<?php

namespace Babypool;

use Babypool\Pirate;
use App\Http\Controllers\Controller;

class PirateController extends Controller {

	public function all(){
		return Pirate::with('bids')->all();
	}

	public function find($id){
		return Pirate::with('bids')->findOrFail($id);
	}
}