<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Landingpage extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function show(){
        return view('landingpage');
    }
}
