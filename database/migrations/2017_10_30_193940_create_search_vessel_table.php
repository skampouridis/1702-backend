<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchVesselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_vessel', function (Blueprint $table) {

            /** Settings */
            $table->engine = 'InnoDB';

            /** Fields */
            $table->integer('id', true);
            $table->integer('search_id');
            $table->integer('vessel_id');

            /** Indexes */
            $table->index('search_id');
            $table->index('vessel_id');

            /** Foreign keys */
            $table->foreign('search_id')->references('id')->on('searches')->onDelete('cascade');
            $table->foreign('vessel_id')->references('id')->on('vessels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_vessel');
    }
}
