<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowStartPage extends Controller
{
    public function __invoke() {
	    $user = Auth::user();
	    $themes = collect([]);

	    if($user != null) {
		    $themes = Theme::User($user->id)->with('sections')->get();
	    }

	    return view('start', ['themes' => $themes]);
    }
}
