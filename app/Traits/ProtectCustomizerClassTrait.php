<?php

namespace App\Traits;

use App\Theme;
use Illuminate\Support\Facades\Auth;

trait ProtectCustomizerClassTrait {

	function checkUserAccess( $theme ) {
		if ( $theme == null ) {
			return false;
		}

		if(is_int($theme) || is_string($theme)) {
			$theme = Theme::find($theme);
		}

		$user = Auth::user();

		if ( $theme->user_id != $user->id ) {
			return false;
		}

		return true;
	}
}