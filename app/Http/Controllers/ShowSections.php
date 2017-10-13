<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class ShowSections extends Controller
{
	public function __invoke($themeId) {
		$sections = Section::Theme($themeId)->get();
		return view('sections', ["themeId" => $themeId, "sections" => $sections]);
	}
}
