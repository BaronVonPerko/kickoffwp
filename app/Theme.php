<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model {
	protected $fillable = [ 'name', 'user_id' ];

	public function scopeUser( $query, $userid ) {
		return $query->where( 'user_id', $userid );
	}
}
