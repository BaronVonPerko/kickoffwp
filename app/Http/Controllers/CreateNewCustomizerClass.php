<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use Illuminate\Http\Request;

class CreateNewCustomizerClass extends Controller
{
    public function __invoke(Request $request) {
	    $theme = $request->get('theme_name');
	    $section = $request->get('section_name');

	    CustomizerClass::create([
	    	"theme_name" => $theme,
		    "section_name" => $section
	    ]);
    }
}
