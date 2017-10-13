<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;

class ShowProfile extends Controller
{
    public function __invoke() {
	    $user = \Illuminate\Support\Facades\Auth::user();
	    $themes = null;

	    if($user != null) {
		    $themes = Theme::User($user->id)->with('sections')->get();
	    }

	    return view('profile', ['themes' => $themes]);
    }
}
