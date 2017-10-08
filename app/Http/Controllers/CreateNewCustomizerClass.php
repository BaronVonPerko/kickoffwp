<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateNewCustomizerClass extends Controller {
	public function __invoke( Request $request ) {
		$theme   = $request->get( 'theme_name' );
		$section = $request->get( 'section_name' );
		$user    = Auth::user();

		$customizerClass = CustomizerClass::create( [
			"user_id"      => $user != null ? $user->id : null,
			"theme_name"   => $theme,
			"section_name" => $section
		] );

		return redirect( '/fields/' . $customizerClass->id );
	}
}
