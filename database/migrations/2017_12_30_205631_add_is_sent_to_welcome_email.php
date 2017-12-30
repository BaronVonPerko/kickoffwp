<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsSentToWelcomeEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('welcome_email_addresses', function (Blueprint $table) {
		    $table->boolean('is_sent')->default(false);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('welcome_email_addresses', function (Blueprint $table) {
		    $table->dropColumn('is_sent');
	    });
    }
}
