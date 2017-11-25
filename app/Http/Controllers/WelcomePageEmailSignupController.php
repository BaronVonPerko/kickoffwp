<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmailSignupAlert;
use App\WelcomeEmailAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class WelcomePageEmailSignupController extends Controller
{
    public function signup(Request $request) {
    	$email = $request->get('email');

    	$exists = WelcomeEmailAddress::where('email', $email)->count();

    	if($exists > 0) {
    		return response(["error" => "Email already signed up"], 200);
	    }

    	WelcomeEmailAddress::create(['email' => $email]);

    	try {
		    Mail::to( env( 'MAIL_TO_ADDRESS' ) )
		        ->send( new WelcomeEmailSignupAlert( $email ) );
	    } catch (\Exception $e) {
    		report($e);
    		return response([], 200);
	    }

	    return response(["success" => true], 200);
    }
}
