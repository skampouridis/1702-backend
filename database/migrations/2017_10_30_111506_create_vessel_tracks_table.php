<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // TODO fix fields data types to optimize database

        Schema::create('vessel_tracks', function (Blueprint $table) {

            /** Settings */
            $table->engine = 'InnoDB';

            /** Fields */
            $table->integer('id', true);
            $table->integer('vessel_id');
            $table->tinyInteger('status');
            $table->mediumInteger('speed');
            $table->decimal('lon', 7, 5);
            $table->decimal('lat', 7, 5);
            $table->mediumInteger('course');
            $table->mediumInteger('heading');
            $table->string('rot', 20)->nullable();
            $table->timestamp('timestamp')->nullable();

            /** Indexes */
            $table->index('vessel_id');
            $table->index('lon');
            $table->index('lat');
            $table->index('timestamp');

            /** Foreign keys */
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
        Schema::dropIfExists('vessel_tracks');
    }
}
