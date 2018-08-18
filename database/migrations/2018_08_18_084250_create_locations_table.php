<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id', false, true)->nullable()->default(null);
	        $table->integer('province_id', false, true)->nullable()->default(null);
	        $table->integer('city_id', false, true)->nullable()->default(null);

	        $table->foreign('country_id')->references('id')->on('countries');
	        $table->foreign('province_id')->references('id')->on('provinces');
	        $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
