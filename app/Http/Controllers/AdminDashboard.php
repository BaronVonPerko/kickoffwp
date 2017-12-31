<?php

namespace App\Http\Controllers;

use App\CustomizerField;
use App\Section;
use App\Theme;
use App\User;
use Illuminate\Http\Request;

class AdminDashboard extends Controller {
	public function __invoke() {
		return view( 'admin.dashboard', [
			'numUsers'       => User::count(),
			'activeThemes'   => Theme::count(),
			'totalThemes'    => Theme::withTrashed()->count(),
			'activeSections' => Section::count(),
			'totalSections'  => Section::withTrashed()->count(),
			'activeFields'   => CustomizerField::count(),
			'totalFields'    => CustomizerField::withTrashed()->count(),
		] );
	}
}
