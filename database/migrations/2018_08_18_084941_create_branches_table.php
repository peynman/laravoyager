<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create( 'branches', function ( Blueprint $table )
	    {
		    $table->increments( 'id' );
		    $table->string( 'title' );
		    $table->integer( 'location_id', false, true );
		    $table->timestamps();

		    $table->foreign( 'location_id' )->references( 'id' )->on( 'locations' );
	    } );

	    Schema::create( 'branch_phone_pivot', function ( Blueprint $table )
	    {
	    	$table->integer('branch_id', false, true);
	    	$table->integer('phone_id', false, true);

		    $table->foreign( 'branch_id' )->references( 'id' )->on( 'branches' );
		    $table->foreign( 'phone_id' )->references( 'id' )->on( 'phones' );
	    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('branch_phone_pivot');
        Schema::dropIfExists('branches');
    }
}
