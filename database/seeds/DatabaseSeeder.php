<?php

use Illuminate\Database\Seeder;
use App\ShipPositionsListImport;
use App\Vessel;
use App\Position;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ShipPositionsListImport $import
     * @return void
     */
    public function run(ShipPositionsListImport $import)
    {
        //  Change delimiter of the Excel plugin from its default value '.' to ';'
        config(['excel.csv.delimiter' => ';']);

        // Import rows from the ship positions list file into the database in chunks
        $import->chunk(250, function ($results) {
            foreach ($results as $row) {

                // Inserts a vessel with the mmsi if it is not already stored
                Vessel::firstOrCreate(
                    ['mmsi' => $row->mmsi], ['status' => $row->status]
                );

                // Inserts a position
                Position::create(
                    [
                        'mmsi' => $row->mmsi,
                        'status' => $row->status,
                        'speed' => $row->speed,
                        'longtitude' => str_replace(',', '.', $row->lon),
                        'latitude' => str_replace(',', '.', $row->lat),
                        'course' => $row->course,
                        'heading' => $row->heading,
                        'rot' => $row->rot == 'NULL' ? null : $row->rot,
                        'timestamp' => $row->timestamp, // converted from the current time zone to UTC for storage,
                                                        // for retrieval it is converted back from UTC to the
                                                        // current time zone
                    ]
                );
            }
        });
    }
}
