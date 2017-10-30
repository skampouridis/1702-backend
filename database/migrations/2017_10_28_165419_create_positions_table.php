<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id'); // unique position identifier as an auto-increment unsigned integer
            $table->unsignedInteger('mmsi'); // unique vessel identifier as an unsigned integer
            $table->integer('status'); // AIS vessel status
            $table->unsignedInteger('station')->nullable(); // nullable receiving station ID as an unsigned integer
            $table->unsignedInteger('speed'); // speed in knots x 10 (i.e. 10,1 knots is 101)
            $table->decimal('longtitude', 8, 5); // longitude in ###.##### format
            $table->decimal('latitude', 8, 5); // latitude in ###.##### format
            $table->unsignedInteger('course'); // vessel's course over ground as an unsigned integer
            $table->unsignedInteger('heading'); // vessel's true heading as an unsigned integer
            $table->integer('rot')->nullable(); // nullable vessel's rate of turn
            $table->timestamp('timestamp'); // position's timestamp

            $table->foreign('mmsi')->references('mmsi')->on('vessels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
