<?php

namespace App\Http\Controllers;

use App\CustomizerClass;
use App\CustomizerField;
use App\Section;
use App\Theme;
use App\Traits\ProtectCustomizerClassTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomizerFieldsController extends Controller {

	use ProtectCustomizerClassTrait;

	/**
	 * Show the fields form view.
	 */
	public function showFields( Request $request, $themeId, $sectionId ) {
		$theme = Theme::find( $themeId );

		if ( ! $this->checkUserAccess( $theme ) ) {
			return redirect( '/404' );
		}

		$section = Section::find( $sectionId );

		$fields = $section->fields()->get();

		return view( 'fields', [ 'theme' => $theme, 'section' => $section, 'fields' => $fields ] );
	}

	/**
	 * Save the fields.
	 */
	public function create( Request $request, $themeId, $sectionId ) {
		$theme = Theme::find( $themeId );

		if ( ! $this->checkUserAccess( $theme ) ) {
			return redirect( '/404' );
		}

		$label   = $request->get( 'label' );
		$default = $request->get( 'default' );

		return CustomizerField::create( [
			"label"      => $label,
			"default"    => $default,
			"section_id" => $sectionId,
		] );
	}
}
