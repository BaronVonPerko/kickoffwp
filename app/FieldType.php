<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model {
	protected $fillable = [ 'name' ];

	public function scopeOrder( $query ) {
    	return $query->orderBy('rank');
	}
}
