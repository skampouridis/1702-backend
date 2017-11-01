<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        /** Call Table Seeder classes with desired order with desired data. */

        $this->call([
            VesselsTableSeeder::class,
            VesselTracksTableSeeder::class
        ]);
    }
}
