<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Validator;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validate(Request $request, array $rules = []){
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            throw new ValidationException();
        }
    }

    public function get_valid_token($token, $rules){
        $decrypted = decrypt($token);
        $validator = Validator::make($decrypted, $rules);

        if ($validator->fails()){

        }

        return $decrypted;
    }
}
