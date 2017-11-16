<?php

namespace App\Http\Controllers;

use App\CustomizerField;
use App\Http\Requests\FieldRequest;
use App\Section;
use App\Theme;
use App\Traits\ProtectCustomizerClassTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldsController extends Controller {
	use ProtectCustomizerClassTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index( Request $request, $themeId, $sectionId ) {
		$theme = Theme::find( $themeId );

		if ( ! $this->checkUserAccess( $theme ) ) {
			return redirect( '/404' );
		}

		$section = Section::find( $sectionId );

		$fields = $section->fields()->get();

		return view( 'fields', [ 'theme' => $theme, 'section' => $section, 'fields' => $fields ] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request, $themeId, $sectionId ) {
		$theme = Theme::find( $themeId );

		if ( ! $this->checkUserAccess( $theme ) ) {
			return redirect( '/404' );
		}

		$label   = $request->get( 'label' );
		$default = $request->get( 'default' );
		$typeId  = $request->get( 'type_id' );

		if ( $typeId == null ) {
			$typeId = 1;
		}

		return CustomizerField::create( [
			"label"      => $label,
			"default"    => $default,
			"section_id" => $sectionId,
			"type_id"    => $typeId,
		] );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( FieldRequest $request, $themeId, $sectionId, $id ) {
		$field = CustomizerField::find( $id );

		if ( $field == null ) {
			return response()->json( [ "success" => false ] );
		}

		$section = Section::find($field->section_id);

		if($section->theme_id != $themeId or $section->id != $sectionId) {
			return response()->json(["success" => false, "message" => "Invalid ID"]);
		}

		$theme = Theme::find($section->theme_id);

		if(!is_null($theme->user_id) and $theme->user_id != Auth::id()) {
			return response()->json(["success" => false, "message" => "Invalid ID"]);
		}

		$field->update( $request->validated() );
		return response()->json( [ "success" => true ] );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
