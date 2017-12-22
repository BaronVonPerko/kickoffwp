<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowDefaultColumnToFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->boolean('allow_default')->nullable();
	    });

	    \App\FieldType::where('name', 'Text Input')->update(['allow_default' => true]);
	    \App\FieldType::where('name', 'Text Area')->update(['allow_default' => true]);
	    \App\FieldType::where('name', 'Color Control')->update(['allow_default' => true]);
	    \App\FieldType::where('name', 'Upload Control')->update(['allow_default' => false]);
	    \App\FieldType::where('name', 'Image Control')->update(['allow_default' => false]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->dropColumn('allow_default');
	    });
    }
}
