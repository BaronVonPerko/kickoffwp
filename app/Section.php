<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {
	protected $fillable = [ 'name', 'theme_id' ];

	function scopeSectionTheme( $query, $themeId ) {
		return $query->where( 'theme_id', $themeId );
	}

	function fields() {
		return $this->hasMany("\App\CustomizerField");
	}

	function theme() {
		return $this->belongsTo("\App\Theme");
	}
}
