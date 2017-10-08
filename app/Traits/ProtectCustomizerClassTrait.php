<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait ProtectCustomizerClassTrait {

	function checkUserAccess( $class ) {
		if ( $class == null ) {
			return false;
		}

		$user = Auth::user();

		if ( $user != null && $class->user_id != $user->id ) {
			return false;
		}

		if ( $user == null && $class->user_id != null ) {
			return false;
		}

		return true;
	}
}