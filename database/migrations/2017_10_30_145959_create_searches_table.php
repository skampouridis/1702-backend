<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {

            /** Settings */
            $table->engine = 'InnoDB';

            /** Fields */
            $table->integer('id', true);
            $table->integer('client_id');
            $table->decimal('lon_from', 7, 5)->nullable();
            $table->decimal('lon_to', 7, 5)->nullable();
            $table->decimal('lat_from', 7, 5)->nullable();
            $table->decimal('lat_to', 7, 5)->nullable();
            $table->timestamp('time_from')->nullable();
            $table->timestamp('time_to')->nullable();
            $table->integer('results')->default(0);
            $table->timestamp('created_at')->useCurrent();

            /** Indexes */
            $table->index('client_id');

            /** Foreign keys */
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('searches');
    }
}
