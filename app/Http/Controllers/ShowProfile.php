<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProfile extends Controller
{
    public function __invoke() {
	    $user = \Illuminate\Support\Facades\Auth::user();
	    $customizerList = null;

	    if($user != null) {
		    $customizerList = \App\CustomizerClass::where('user_id', $user->id)->get();
	    }

	    return view('profile', ['customizers' => $customizerList]);
    }
}
