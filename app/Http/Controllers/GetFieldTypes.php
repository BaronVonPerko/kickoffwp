<?php

namespace App\Http\Controllers;

use App\FieldType;
use Illuminate\Http\Request;

class GetFieldTypes extends Controller
{
    public function __invoke() {
	    return response()->json(FieldType::get());
    }
}
