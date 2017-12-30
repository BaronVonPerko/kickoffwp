<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WelcomeEmailAddress extends Model {
	protected $fillable = [ 'email', 'is_sent' ];

	function scopeSignedUpToday( $query ) {
    	return $query->whereDate('created_at', date('Y-m-d'));
	}

	function markSent() {
		$this->update(['is_sent' => true]);
	}

	function scopeNotSent($query) {
		return $query->whereIsSent(0);
	}
}
