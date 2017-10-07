<?php

namespace App\Http\Controllers;

use App\WelcomeEmailAddress;
use Illuminate\Http\Request;

class WelcomePageEmailSignupController extends Controller
{
    public function signup(Request $request) {
    	$email = $request->get('email');

    	$exists = WelcomeEmailAddress::where('email', $email)->count();

    	if($exists > 0) {
    		return response(["error" => "Email already signed up"], 200);
	    }

    	WelcomeEmailAddress::create(['email' => $email]);
    }
}
