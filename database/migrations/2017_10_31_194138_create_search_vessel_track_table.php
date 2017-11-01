<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchVesselTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_vessel_track', function (Blueprint $table) {

            /** Settings */
            $table->engine = 'InnoDB';

            /** Fields */
            $table->integer('id', true);
            $table->integer('search_id');
            $table->integer('vessel_track_id');

            /** Indexes */
            $table->index('search_id');
            $table->index('vessel_track_id');

            /** Foreign Keys */
            $table->foreign('search_id')->references('id')->on('searches')->onDelete('cascade');
            $table->foreign('vessel_track_id')->references('id')->on('vessel_tracks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_vessel_track');
    }
}
