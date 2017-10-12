<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProfile extends Controller
{
    public function __invoke() {
	    $user = \Illuminate\Support\Facades\Auth::user();
	    $themes = null;

	    if($user != null) {
		    $themes = \App\Theme::User($user->id)->get();
	    }

	    return view('profile', ['themes' => $themes]);
    }
}
