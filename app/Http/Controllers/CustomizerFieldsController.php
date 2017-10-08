<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizerFieldsController extends Controller {

	/**
	 * Show the fields form view.
	 */
	public function showFields(Request $request, $id) {
		$class = CustomizerClass::find($id);

		if($class == null) {
			return redirect('/404');
		}

		$user = Auth::user();

		if($user != null && $class->user_id != $user->id) {
			return redirect('/404');
		}

		if($user == null && $class->user_id != null) {
			return redirect('/404');
		}

		return view('fields', ['class' => $class]);
	}

	/**
	 * Save the fields.
	 */
	public function save() {
		//
	}
}
