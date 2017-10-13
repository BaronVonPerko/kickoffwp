<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {
	protected $fillable = [ 'name', 'theme_id' ];

	function scopeTheme( $query, $themeId ) {
		return $query->where( 'theme_id', $themeId );
	}
}
