<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model {
	protected $fillable = [ 'name', 'user_id' ];

	public function name( $query, $name ) {
		return $query->where( 'name', $name );
	}
}
