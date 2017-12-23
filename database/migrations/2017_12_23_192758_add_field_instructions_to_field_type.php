<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInstructionsToFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->string('instructions')->nullable();
	    });

	    \App\FieldType::where('name', 'Color Control')
	                  ->update(['instructions' => 'Enter the 6 digit hex code (without the \'#\')']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->dropColumn('instructions');
	    });
    }
}
