<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRankToFieldType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->integer('rank')->nullable();
	    });

	    \App\FieldType::where('name', 'Text Input')->update(['rank' => 1]);
	    \App\FieldType::where('name', 'Text Area')->update(['rank' => 2]);
	    \App\FieldType::where('name', 'Color Control')->update(['rank' => 3]);
	    \App\FieldType::where('name', 'Upload Control')->update(['rank' => 4]);
	    \App\FieldType::where('name', 'Image Control')->update(['rank' => 5]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('field_types', function (Blueprint $table) {
		    $table->dropColumn('rank');
	    });
    }
}
