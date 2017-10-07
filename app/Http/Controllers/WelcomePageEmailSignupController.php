<?php

namespace App\Http\Controllers;

use App\WelcomeEmailAddress;
use Illuminate\Http\Request;

class WelcomePageEmailSignupController extends Controller
{
    public function signup(Request $request) {
    	$email = $request->get('email');

    	WelcomeEmailAddress::create(['email' => $email]);
    }
}
