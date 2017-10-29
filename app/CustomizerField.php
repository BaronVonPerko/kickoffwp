<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizerField extends Model
{
    protected $fillable = ['label', 'default', 'section_id', 'type_id'];

    public function scopeSection($query, $sectionId) {
    	return $query->where('section_id', $sectionId);
    }

    public function type() {
    	return $this->belongsTo('FieldType');
    }
}
