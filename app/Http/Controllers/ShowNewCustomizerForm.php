<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowNewCustomizerForm extends Controller
{
    public function __invoke() {
	    return view('newCustomizerClass');
    }
}
