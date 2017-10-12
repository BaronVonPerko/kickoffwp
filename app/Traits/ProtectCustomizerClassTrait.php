<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ProtectCustomizerClassTrait {

	function checkUserAccess( $theme ) {
		if ( $theme == null ) {
			return false;
		}

		$user = Auth::user();

		if ( $user != null && $theme->user_id != $user->id ) {
			return false;
		}

		if ( $user == null && $theme->user_id != null ) {
			return false;
		}

		return true;
	}
}