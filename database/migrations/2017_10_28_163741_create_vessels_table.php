<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->unsignedInteger('mmsi'); // unique vessel identifier as an unsigned integer
            $table->string('name')->nullable(); // nullable vessel's name
            $table->integer('status'); // AIS vessel status
            $table->timestamps(); // nullable created_at and updated_at columns

            $table->primary('mmsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels');
    }
}
