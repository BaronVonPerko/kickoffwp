<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizerClass extends Model
{
    protected $fillable = ['user_id', 'theme_name', 'section_name'];

    public function scopeUser($query, $userId) {
    	return $query->where('user_id', $userId);
    }
}
