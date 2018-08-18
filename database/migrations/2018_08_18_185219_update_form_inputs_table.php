<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFormInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('form_inputs', function (Blueprint $table) {
	    	$table->enum('type', [
	    		'select',
			    'select_province',
			    'select_city',
			    'text',
			    'number',
			    'email',
			    'text_area',
			    'checkbox',
			    'radio'
		    ])->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
