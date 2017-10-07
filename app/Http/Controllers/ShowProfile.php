<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Controller
{

	/**
	 * Show the profile page.  Pass the user information if they are logged in.
	 */
    public function __invoke() {
    	$user = Auth::user();

	    return view('profile', ['user' => $user]);
    }
}
