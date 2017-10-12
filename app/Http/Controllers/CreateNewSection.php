<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class CreateNewSection extends Controller {
	public function __invoke( Request $request, $themeId ) {
		$name = $request->get( 'name' );

		$section = Section::create( [
			"name"     => $name,
			"theme_id" => $themeId
		] );

		return redirect( "/theme/$themeId/sections/$section->id/fields" );
	}
}
