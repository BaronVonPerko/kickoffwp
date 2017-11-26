<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WelcomeEmailAddress extends Model {
	protected $fillable = [ 'email' ];

	function scopeSignedUpToday( $query ) {
    	return $query->whereDate('created_at', date('Y-m-d'));
	}
}
