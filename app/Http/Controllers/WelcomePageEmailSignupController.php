<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmailSignupAlert;
use App\WelcomeEmailAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WelcomePageEmailSignupController extends Controller
{
    public function signup(Request $request) {
    	$email = $request->get('email');

    	$exists = WelcomeEmailAddress::where('email', $email)->count();

    	if($exists > 0) {
    		return response(["error" => "Email already signed up"], 200);
	    }

    	WelcomeEmailAddress::create(['email' => $email]);

    	Mail::to(env('ADMIN_EMAIL'))
	        ->send(new WelcomeEmailSignupAlert($email));
    }
}
