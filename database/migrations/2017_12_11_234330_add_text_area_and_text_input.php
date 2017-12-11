<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTextAreaAndTextInput extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up() {
		\App\FieldType::create( [ 'name' => 'Text Input' ] );
		\App\FieldType::create( [ 'name' => 'Text Area' ] );
		\App\FieldType::where( 'name', 'General Input' )->first()->delete();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		\App\FieldType::create( [ 'name' => 'General Input' ] );
		\App\FieldType::where( 'name', 'Text Input' )->first()->delete();
		\App\FieldType::where( 'name', 'Text Area' )->first()->delete();
	}
}
