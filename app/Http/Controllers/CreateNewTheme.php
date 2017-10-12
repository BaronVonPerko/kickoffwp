<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Theme;

class CreateNewTheme extends Controller {
	public function __invoke( Request $request ) {
		$theme = $request->get( 'name' );
		$user  = Auth::user();

		$theme = Theme::create( [
			"user_id" => $user != null ? $user->id : null,
			"name"    => $theme,
		] );

		return redirect( '/theme/' . $theme->id . '/sections' );
	}
}
