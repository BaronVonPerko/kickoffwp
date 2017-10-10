<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizerField extends Model
{
    protected $fillable = ['label', 'default', 'class_id'];

    public function scopeClass($query, $classId) {
    	return $query->where('class_id', $classId);
    }
}
