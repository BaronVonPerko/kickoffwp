<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model {

	use SoftDeletes;

	protected $fillable = [ 'name', 'user_id' ];

	public function scopeUser( $query, $userid ) {
		return $query->where( 'user_id', $userid );
	}

	public function sections() {
		return $this->hasMany('\App\Section');
	}
}
