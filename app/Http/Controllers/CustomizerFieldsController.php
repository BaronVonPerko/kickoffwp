<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use App\CustomizerField;
use App\Traits\ProtectCustomizerClassTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizerFieldsController extends Controller {

	use ProtectCustomizerClassTrait;

	/**
	 * Show the fields form view.
	 */
	public function showFields( Request $request, $id ) {
		$class = CustomizerClass::find( $id );

		if(!$this->checkUserAccess($class)) {
			return redirect('/404');
		}

		return view( 'fields', [ 'class' => $class ] );
	}

	/**
	 * Save the fields.
	 */
	public function create( Request $request, $id ) {
		$class = CustomizerClass::find( $id );

		if(!$this->checkUserAccess($class)) {
			return redirect('/404');
		}

		$label   = $request->get( 'label' );
		$default = $request->get( 'default' );

		return CustomizerField::create( [
			"label"    => $label,
			"default"  => $default,
			"class_id" => $id,
		] );
	}
}
