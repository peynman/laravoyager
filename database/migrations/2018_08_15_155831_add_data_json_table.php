<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataJsonTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table( 'menu_items', function ( Blueprint $table )
		{
			$table->json( 'data' )->nullable()->default(null);
		} );

		Schema::create( 'menu_items_relations', function ( Blueprint $table )
		{
			$table->integer( 'parent_id', false, true);
			$table->integer('child_id', false, true);

			$table->foreign('parent_id')->references('id')->on('menu_items');
			$table->foreign('child_id')->references('id')->on('menu_items');
		} );

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table( 'menu_items', function ( Blueprint $table ) {
			$table->dropColumn('data');
		} );

		Schema::dropIfExists('menu_items_relations');
	}
}
